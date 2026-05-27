<?php

namespace App\Http\Controllers;

use App\Models\Assignment;
use App\Models\AssignmentSubmission;
use App\Models\Course;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\IOFactory as WordIOFactory;

class AssignmentController extends Controller
{
    public function index()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        abort_unless($user->hasPermissionTo('assignments.view'), 403, 'Ruxsat etilmagan.');

        // If user has permission to grade, show all assignments (Teacher/Admin view)
        if ($user->hasPermissionTo('assignments.grade')) {
            $assignments = Assignment::with('course', 'submissions')
                ->orderBy('created_at', 'desc')
                ->paginate(10);
        } else {
            // Otherwise, show only assignments for enrolled courses (Student view)
            $assignments = Assignment::whereHas('course', function ($query) use ($user) {
                $query->whereHas('students', function ($q) use ($user) {
                    $q->where('user_id', $user->id);
                });
            })
                ->with('course', 'submissions')
                ->orderBy('created_at', 'desc')
                ->paginate(10);
        }

        return view('assignments.index', compact('assignments'));
    }

    public function create()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        abort_unless($user->hasPermissionTo('assignments.create'), 403, 'Ruxsat etilmagan.');

        $courses = Course::all();
        return view('assignments.create', compact('courses'));
    }

    public function store(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        abort_unless($user->hasPermissionTo('assignments.create'), 403, 'Ruxsat etilmagan.');

        $validated = $request->validate([
            'title'       => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'course_id'   => ['required', 'exists:courses,id'],
            'due_date'    => ['required', 'date'],
            'max_score'   => ['required', 'integer', 'min:1', 'max:100'],
            'file'        => ['nullable', 'file', 'max:10240'],
        ]);

        $filePath = null;
        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('assignments', 'public');
        }

        Assignment::create([
            'title'       => $validated['title'],
            'description' => $validated['description'],
            'course_id'   => $validated['course_id'],
            'teacher_id'  => $user->id,
            'due_date'    => $validated['due_date'],
            'max_score'   => $validated['max_score'],
            'status'      => 'active',
            'file_path'   => $filePath,
        ]);

        return redirect()->route('assignments.index')->with('success', 'Topshiriq muvaffaqiyatli yaratildi!');
    }

    public function show(Assignment $assignment)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        abort_unless($user->hasPermissionTo('assignments.view'), 403, 'Ruxsat etilmagan.');

        $assignment->load('course', 'teacher', 'submissions.user');

        // Fetch the specific submission for the student
        $userSubmission = $assignment->submissions()->where('user_id', $user->id)->first();

        return view('assignments.show', compact('assignment', 'userSubmission'));
    }

    public function edit(Assignment $assignment)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        abort_unless($user->hasPermissionTo('assignments.edit'), 403, 'Ruxsat etilmagan.');

        // Fetch all courses to populate the select dropdown
        $courses = Course::all();

        return view('assignments.edit', compact('assignment', 'courses'));
    }

    public function update(Request $request, Assignment $assignment)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        abort_unless($user->hasPermissionTo('assignments.edit'), 403, 'Ruxsat etilmagan.');

        $validated = $request->validate([
            'title'       => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'course_id'   => ['required', 'exists:courses,id'],
            'due_date'    => ['required', 'date'],
            'max_score'   => ['required', 'integer', 'min:1', 'max:100'],
            'file'        => ['nullable', 'file', 'max:10240'],
        ]);

        $filePath = $assignment->file_path;

        // Handle file upload and replace the old file if a new one is uploaded
        if ($request->hasFile('file')) {
            if ($filePath && Storage::disk('public')->exists($filePath)) {
                Storage::disk('public')->delete($filePath);
            }
            $filePath = $request->file('file')->store('assignments', 'public');
        }

        // Update the assignment record in the database
        $assignment->update([
            'title'       => $validated['title'],
            'description' => $validated['description'],
            'course_id'   => $validated['course_id'],
            'due_date'    => $validated['due_date'],
            'max_score'   => $validated['max_score'],
            'file_path'   => $filePath,
        ]);

        return redirect()->route('assignments.index')->with('success', 'Topshiriq muvaffaqiyatli yangilandi!');
    }

    public function submit(Request $request, Assignment $assignment)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        abort_unless($user->hasPermissionTo('assignments.submit'), 403, 'Ruxsat etilmagan.');

        abort_if($user->hasPermissionTo('assignments.grade'), 403, 'Adminlar va O\'qituvchilar topshiriq yubora olmaydi.');

        // Prevent accessing the editor if submission already exists
        $existingSubmission = AssignmentSubmission::where('assignment_id', $assignment->id)
            ->where('user_id', $user->id)
            ->first();

        if ($existingSubmission) {
            return redirect()->route('assignments.show', $assignment)
                ->with('error', 'Siz allaqachon bu vazifani yuborgansiz. Boshqa yuklash mumkin emas.');
        }

        // Handle GET request (Show the form)
        if ($request->isMethod('get')) {
            // Return view based on the blade file name you are using
            $viewName = view()->exists('assignments.submit') ? 'assignments.submit' : 'assignments.editor';
            return view($viewName, compact('assignment'));
        }

        // Handle POST request (Process submission)
        $request->validate([
            'assignment_type' => 'required|in:word,excel',
            'word_content'    => 'nullable|string',
            'excel_content'   => 'nullable|string',
        ]);

        $type = $request->input('assignment_type');
        $fileName = 'assignment_' . $assignment->id . '_user_' . $user->id . '_' . time();
        $filePath = '';

        $directory = 'submissions/' . $assignment->id;
        if (!Storage::disk('public')->exists($directory)) {
            Storage::disk('public')->makeDirectory($directory);
        }

        if ($type === 'word' && !empty($request->input('word_content'))) {
            // Generate Word (.docx) file
            $htmlContent = $request->input('word_content');
            $fileName .= '.docx';
            $fullFilePath = storage_path('app/public/' . $directory . '/' . $fileName);
            $filePath = $directory . '/' . $fileName;

            $phpWord = new PhpWord();
            $section = $phpWord->addSection();
            \PhpOffice\PhpWord\Shared\Html::addHtml($section, $htmlContent, false, false);
            $objWriter = WordIOFactory::createWriter($phpWord, 'Word2007');
            $objWriter->save($fullFilePath);
        } elseif ($type === 'excel' && !empty($request->input('excel_content'))) {
            // Generate CSV file for Excel compatibility
            $excelJson = $request->input('excel_content');
            $dataArray = json_decode($excelJson, true);

            $fileName .= '.csv';
            $fullFilePath = storage_path('app/public/' . $directory . '/' . $fileName);
            $filePath = $directory . '/' . $fileName;

            $file = fopen($fullFilePath, 'w');
            fputs($file, "\xEF\xBB\xBF"); // UTF-8 BOM

            if (is_array($dataArray) && count($dataArray) > 0) {
                foreach ($dataArray as $row) {
                    if (is_array($row)) fputcsv($file, $row);
                }
            }
            fclose($file);
        } else {
            return back()->with('error', 'Iltimos, vazifani to\'liq kiriting.');
        }

        // Save submission as a new record
        AssignmentSubmission::create([
            'assignment_id' => $assignment->id,
            'user_id'       => $user->id,
            'file_path'     => $filePath,
            'status'        => 'submitted',
            'submitted_at'  => now(),
        ]);

        return redirect()->route('assignments.show', $assignment)->with('success', 'Vazifa yuborildi!');
    }

    public function download(AssignmentSubmission $submission)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        abort_unless($user->hasPermissionTo('assignments.view'), 403, 'Ruxsat etilmagan.');

        if (!$submission->file_path || !Storage::disk('public')->exists($submission->file_path)) {
            abort(404, 'Fayl topilmadi');
        }
        return response()->download(Storage::disk('public')->path($submission->file_path));
    }

    public function grade(Request $request, AssignmentSubmission $submission)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        abort_unless($user->hasPermissionTo('assignments.grade'), 403, 'Ruxsat etilmagan.');

        $validated = $request->validate([
            'score'    => 'required|integer|min:0|max:' . $submission->assignment->max_score,
            'feedback' => 'nullable|string|max:1000',
        ]);

        $submission->update([
            'score'     => $validated['score'],
            'feedback'  => $validated['feedback'] ?? null,
            'status'    => 'graded',
            'graded_at' => now(),
        ]);

        return back()->with('success', 'Baho qo\'yildi!');
    }

    public function destroy(Assignment $assignment)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        abort_unless($user->hasPermissionTo('assignments.delete'), 403, 'Ruxsat etilmagan.');

        if ($assignment->file_path && Storage::disk('public')->exists($assignment->file_path)) {
            Storage::disk('public')->delete($assignment->file_path);
        }

        $assignment->delete();
        return redirect()->route('assignments.index')->with('success', 'Topshiriq o\'chirildi!');
    }
}
