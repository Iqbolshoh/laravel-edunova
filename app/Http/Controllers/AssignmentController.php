<?php

namespace App\Http\Controllers;

use App\Models\Assignment;
use App\Models\AssignmentSubmission;
use App\Models\Course;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\IOFactory as WordIOFactory;
use PhpOffice\PhpWord\Shared\Html;

class AssignmentController extends Controller
{
    /**
     * Barcha topshiriqlarni ko'rsatish
     */
    public function index()
    {
        /** @var User $user */
        $user = Auth::user();
        abort_unless($user->hasPermissionTo('assignments.view'), 403, 'Ruxsat etilmagan.');

        // Agar o'qituvchi bo'lsa, o'zining topshiriqlari
        if ($user->hasRole('teacher')) {
            $assignments = Assignment::where('teacher_id', $user->id)
                ->with('course', 'submissions')
                ->orderBy('created_at', 'desc')
                ->paginate(10);
        }
        // Agar talaba bo'lsa, kursidagi topshiriqlar
        else {
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

    /**
     * Yangi topshiriq yaratish formasi
     */
    public function create()
    {
        /** @var User $user */
        $user = Auth::user();
        abort_unless($user->hasPermissionTo('assignments.create'), 403, 'Ruxsat etilmagan.');

        $courses = Course::where('teacher_id', Auth::id())->get();
        return view('assignments.create', compact('courses'));
    }

    /**
     * Yangi topshiriqni saqlash
     */
    public function store(Request $request)
    {
        /** @var User $user */
        $user = Auth::user();
        abort_unless($user->hasPermissionTo('assignments.create'), 403, 'Ruxsat etilmagan.');

        $validated = $request->validate([
            'title'       => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'course_id'   => ['required', 'exists:courses,id'],
            'due_date'    => ['required', 'date', 'after:today'],
            'max_score'   => ['required', 'integer', 'min:1', 'max:100'],
            'file'        => ['nullable', 'file', 'max:10240'],
        ], [
            'title.required'       => 'Topshiriq nomi kiritilishi shart.',
            'description.required' => 'Topshiriq tavsifi kiritilishi shart.',
            'course_id.required'   => 'Kurs tanlanishi shart.',
            'course_id.exists'     => 'Tanlangan kurs mavjud emas.',
            'due_date.required'    => 'Muddat kiritilishi shart.',
            'due_date.date'        => 'Muddat sana formatida bo\'lishi kerak.',
            'due_date.after'       => 'Muddat bugungi kundan keyin bo\'lishi kerak.',
            'max_score.required'   => 'Maksimal ball kiritilishi shart.',
            'max_score.integer'    => 'Maksimal ball butun son bo\'lishi kerak.',
            'max_score.min'        => 'Maksimal ball 1 dan kam bo\'lmasligi kerak.',
            'max_score.max'        => 'Maksimal ball 100 dan oshmasligi kerak.',
            'file.max'             => 'Fayl hajmi 10MB dan oshmasligi kerak.',
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

        return redirect()->route('assignments.index')
            ->with('success', 'Topshiriq muvaffaqiyatli yaratildi!');
    }

    /**
     * Topshiriqni ko'rsatish
     */
    public function show(Assignment $assignment)
    {
        /** @var User $user */
        $user = Auth::user();
        abort_unless($user->hasPermissionTo('assignments.view'), 403, 'Ruxsat etilmagan.');

        $assignment->load('course', 'teacher', 'submissions.user');

        $userSubmission = $assignment->getUserSubmission(Auth::id());

        return view('assignments.show', compact('assignment', 'userSubmission'));
    }

    /**
     * Word/Excel muharririni ochish
     */
    public function editor(Assignment $assignment)
    {
        /** @var User $user */
        $user = Auth::user();
        abort_unless($user->hasPermissionTo('assignments.submit'), 403, 'Ruxsat etilmagan.');

        // Deadline tekshirish
        if ($assignment->isPastDue()) {
            return redirect()->route('assignments.show', $assignment)
                ->with('error', 'Topshiriq muddati o\'tgan!');
        }

        $userSubmission = $assignment->getUserSubmission(Auth::id());

        return view('assignments.editor', compact('assignment', 'userSubmission'));
    }

    /**
     * Topshiriqni yuborish (Word yoki Excel formatida)
     */
    public function submit(Request $request, Assignment $assignment)
    {
        /** @var User $user */
        $user = Auth::user();
        abort_unless($user->hasPermissionTo('assignments.submit'), 403, 'Ruxsat etilmagan.');

        // Validatsiya
        $validated = $request->validate([
            'assignment_type' => ['required', 'in:word,excel'],
            'word_content'    => ['nullable', 'string', 'required_if:assignment_type,word'],
            'excel_content'   => ['nullable', 'string', 'required_if:assignment_type,excel'],
        ], [
            'assignment_type.required'       => 'Topshiriq turi tanlanishi shart.',
            'assignment_type.in'             => 'Noto\'g\'ri topshiriq turi.',
            'word_content.required_if'       => 'Word hujjat matni kiritilishi shart.',
            'excel_content.required_if'      => 'Excel jadvali kiritilishi shart.',
        ]);

        // Deadline tekshirish
        if ($assignment->isPastDue()) {
            return back()->with('error', 'Topshiriq muddati o\'tgan!');
        }

        $type = $validated['assignment_type'];
        $fileName = 'assignment_' . $assignment->id . '_user_' . $user->id . '_' . time();
        $filePath = '';

        $directory = 'submissions/' . $assignment->id;

        // Papka mavjudligini tekshirish va yaratish
        if (!Storage::disk('public')->exists($directory)) {
            Storage::disk('public')->makeDirectory($directory);
        }

        try {
            // WORD HUJJAT YARATISH
            if ($type === 'word' && !empty($validated['word_content'])) {
                $htmlContent = $validated['word_content'];
                $fileName .= '.docx';
                $fullFilePath = storage_path('app/public/' . $directory . '/' . $fileName);
                $filePath = $directory . '/' . $fileName;

                // PhpWord obyektini yaratish
                $phpWord = new PhpWord();

                // Hujjat xususiyatlari
                $properties = $phpWord->getDocInfo();
                $properties->setCreator($user->name);
                $properties->setTitle($assignment->title);
                $properties->setDescription('Topshiriq javobi');
                $properties->setCreated(time());
                $properties->setModified(time());

                // Sahifa qo'shish
                $section = $phpWord->addSection([
                    'marginLeft'  => 720,  // 1 inch = 720 twips
                    'marginRight' => 720,
                    'marginTop'   => 720,
                    'marginBottom' => 720,
                ]);

                // Sarlavha
                $section->addTitle($assignment->title, 1);

                // Ma'lumotlar
                $section->addText('Talaba: ' . $user->name, ['bold' => true]);
                $section->addText('Sana: ' . now()->format('d.m.Y H:i'));
                $section->addText('Kurs: ' . ($assignment->course->title ?? 'N/A'));
                $section->addTextBreak(1);

                // HTML kontentni Word formatiga o'tkazish
                Html::addHtml($section, $htmlContent, false, false);

                // Faylni saqlash
                $objWriter = WordIOFactory::createWriter($phpWord, 'Word2007');
                $objWriter->save($fullFilePath);
            }
            // EXCEL/CSV FAYL YARATISH
            elseif ($type === 'excel' && !empty($validated['excel_content'])) {
                $excelJson = $validated['excel_content'];
                $dataArray = json_decode($excelJson, true);

                $fileName .= '.csv';
                $fullFilePath = storage_path('app/public/' . $directory . '/' . $fileName);
                $filePath = $directory . '/' . $fileName;

                // Faylni yozish uchun ochish
                $file = fopen($fullFilePath, 'w');

                // UTF-8 BOM qo'shish (O'zbekcha harflar uchun)
                fputs($file, "\xEF\xBB\xBF");

                // Ma'lumot sarlavhasi
                fputcsv($file, ['Topshiriq:', $assignment->title]);
                fputcsv($file, ['Talaba:', $user->name]);
                fputcsv($file, ['Sana:', now()->format('d.m.Y H:i')]);
                fputcsv($file, []);

                // Jadval ma'lumotlarini yozish
                if (is_array($dataArray) && count($dataArray) > 0) {
                    foreach ($dataArray as $row) {
                        if (is_array($row)) {
                            fputcsv($file, $row);
                        }
                    }
                }

                fclose($file);
            } else {
                return back()->with('error', 'Iltimos, vazifani to\'liq kiriting.');
            }

            // Ma'lumotlar bazasiga saqlash
            AssignmentSubmission::updateOrCreate(
                [
                    'assignment_id' => $assignment->id,
                    'user_id'       => $user->id,
                ],
                [
                    'content'         => $type === 'word' ? $validated['word_content'] : $validated['excel_content'],
                    'file_path'       => $filePath,
                    'file_name'       => $fileName,
                    'submission_type' => $type,
                    'status'          => 'submitted',
                    'submitted_at'    => now(),
                ]
            );

            return redirect()->route('assignments.show', $assignment)
                ->with('success', 'Topshiriq muvaffaqiyatli yuborildi!');
        } catch (\Exception $e) {
            Log::error('Assignment submission error: ' . $e->getMessage(), [
                'user_id'       => $user->id,
                'assignment_id' => $assignment->id,
                'type'          => $type,
                'trace'         => $e->getTraceAsString()
            ]);

            return back()
                ->with('error', 'Xatolik yuz berdi. Iltimos, qaytadan urinib ko\'ring.')
                ->withInput();
        }
    }

    /**
     * Yuborilgan faylni yuklab olish
     */
    public function download(AssignmentSubmission $submission)
    {
        /** @var User $user */
        $user = Auth::user();
        abort_unless($user->hasPermissionTo('assignments.view'), 403, 'Ruxsat etilmagan.');

        // Fayl mavjudligini tekshirish
        if (!$submission->file_path || !Storage::disk('public')->exists($submission->file_path)) {
            abort(404, 'Fayl topilmadi');
        }

        $filePath = Storage::disk('public')->path($submission->file_path);
        $fileName = $submission->file_name ?? 'topshiriq.docx';

        return response()->download($filePath, $fileName);
    }

    /**
     * Topshiriqni baholash
     */
    public function grade(Request $request, AssignmentSubmission $submission)
    {
        /** @var User $user */
        $user = Auth::user();
        abort_unless($user->hasPermissionTo('assignments.grade'), 403, 'Ruxsat etilmagan.');

        $validated = $request->validate([
            'score'    => ['required', 'integer', 'min:0', 'max:' . $submission->assignment->max_score],
            'feedback' => ['nullable', 'string', 'max:1000'],
        ], [
            'score.required' => 'Baho kiritilishi shart.',
            'score.integer'  => 'Baho butun son bo\'lishi kerak.',
            'score.min'      => 'Baho 0 dan kam bo\'lmasligi kerak.',
            'score.max'      => 'Baho ' . $submission->assignment->max_score . ' dan oshmasligi kerak.',
            'feedback.max'   => 'Izoh 1000 ta belgidan oshmasligi kerak.',
        ]);

        $submission->update([
            'score'     => $validated['score'],
            'feedback'  => $validated['feedback'] ?? null,
            'status'    => 'graded',
            'graded_at' => now(),
        ]);

        return back()->with('success', 'Baho muvaffaqiyatli qo\'yildi!');
    }

    /**
     * Topshiriqni tahrirlash formasi
     */
    public function edit(Assignment $assignment)
    {
        /** @var User $user */
        $user = Auth::user();
        abort_unless($user->hasPermissionTo('assignments.edit'), 403, 'Ruxsat etilmagan.');

        // Faqat o'z topshirig'ini tahrirlay oladi yoki admin
        if ($assignment->teacher_id !== $user->id && !$user->hasRole('admin')) {
            abort(403, 'Ruxsat etilmagan!');
        }

        $courses = Course::where('teacher_id', Auth::id())->get();
        return view('assignments.edit', compact('assignment', 'courses'));
    }

    /**
     * Topshiriqni yangilash
     */
    public function update(Request $request, Assignment $assignment)
    {
        /** @var User $user */
        $user = Auth::user();
        abort_unless($user->hasPermissionTo('assignments.edit'), 403, 'Ruxsat etilmagan.');

        // Faqat o'z topshirig'ini yangilay oladi yoki admin
        if ($assignment->teacher_id !== $user->id && !$user->hasRole('admin')) {
            abort(403, 'Ruxsat etilmagan!');
        }

        $validated = $request->validate([
            'title'       => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'course_id'   => ['required', 'exists:courses,id'],
            'due_date'    => ['required', 'date'],
            'max_score'   => ['required', 'integer', 'min:1', 'max:100'],
            'file'        => ['nullable', 'file', 'max:10240'],
        ], [
            'title.required'       => 'Topshiriq nomi kiritilishi shart.',
            'description.required' => 'Topshiriq tavsifi kiritilishi shart.',
            'course_id.required'   => 'Kurs tanlanishi shart.',
            'course_id.exists'     => 'Tanlangan kurs mavjud emas.',
            'due_date.required'    => 'Muddat kiritilishi shart.',
            'due_date.date'        => 'Muddat sana formatida bo\'lishi kerak.',
            'max_score.required'   => 'Maksimal ball kiritilishi shart.',
            'max_score.integer'    => 'Maksimal ball butun son bo\'lishi kerak.',
            'max_score.min'        => 'Maksimal ball 1 dan kam bo\'lmasligi kerak.',
            'max_score.max'        => 'Maksimal ball 100 dan oshmasligi kerak.',
            'file.max'             => 'Fayl hajmi 10MB dan oshmasligi kerak.',
        ]);

        $updateData = [
            'title'       => $validated['title'],
            'description' => $validated['description'],
            'course_id'   => $validated['course_id'],
            'due_date'    => $validated['due_date'],
            'max_score'   => $validated['max_score'],
        ];

        // Faylni yangilash
        if ($request->hasFile('file')) {
            // Eski faylni o'chirish
            if ($assignment->file_path && Storage::disk('public')->exists($assignment->file_path)) {
                Storage::disk('public')->delete($assignment->file_path);
            }
            // Yangi faylni saqlash
            $updateData['file_path'] = $request->file('file')->store('assignments', 'public');
        }

        $assignment->update($updateData);

        return redirect()->route('assignments.show', $assignment)
            ->with('success', 'Topshiriq muvaffaqiyatli yangilandi!');
    }

    /**
     * Topshiriqni o'chirish
     */
    public function destroy(Assignment $assignment)
    {
        /** @var User $user */
        $user = Auth::user();
        abort_unless($user->hasPermissionTo('assignments.delete'), 403, 'Ruxsat etilmagan.');

        // Faqat o'z topshirig'ini o'chira oladi yoki admin
        if ($assignment->teacher_id !== $user->id && !$user->hasRole('admin')) {
            abort(403, 'Ruxsat etilmagan!');
        }

        // Faylni o'chirish
        if ($assignment->file_path && Storage::disk('public')->exists($assignment->file_path)) {
            Storage::disk('public')->delete($assignment->file_path);
        }

        // Barcha submission fayllarini o'chirish
        foreach ($assignment->submissions as $submission) {
            if ($submission->file_path && Storage::disk('public')->exists($submission->file_path)) {
                Storage::disk('public')->delete($submission->file_path);
            }
        }

        $assignment->delete();

        return redirect()->route('assignments.index')
            ->with('success', 'Topshiriq o\'chirildi!');
    }
}
