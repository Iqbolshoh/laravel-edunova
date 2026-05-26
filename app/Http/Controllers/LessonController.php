<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Lesson;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class LessonController extends Controller
{
    /**
     * Display a listing of lessons for a course.
     */
    public function index(Course $course)
    {
        /** @var User $user */
        $user = Auth::user();
        abort_unless($user->hasPermissionTo('courses.view'), 403, 'Ruxsat etilmagan.');

        $course->load(['teacher', 'lessons' => function ($query) {
            $query->orderBy('order');
        }]);

        return view('lessons.index', compact('course'));
    }

    /**
     * Show the form for creating a new lesson.
     */
    public function create(Course $course)
    {
        /** @var User $user */
        $user = Auth::user();
        abort_unless($user->hasPermissionTo('courses.edit'), 403, 'Ruxsat etilmagan.');

        $nextOrder = $course->lessons()->max('order') + 1;

        return view('lessons.create', compact('course', 'nextOrder'));
    }

    /**
     * Store a newly created lesson.
     */
    public function store(Request $request, Course $course)
    {
        /** @var User $user */
        $user = Auth::user();
        abort_unless($user->hasPermissionTo('courses.edit'), 403, 'Ruxsat etilmagan.');

        $validated = $request->validate([
            'title'       => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'video_url'   => ['nullable', 'url'],
            'file'        => ['nullable', 'file', 'max:10240', 'mimes:pdf,doc,docx,ppt,pptx'],
            'duration'    => ['nullable', 'integer', 'min:1'],
            'order'       => ['required', 'integer', 'min:1'],
            'status'      => ['required', 'in:active,inactive'],
        ], [
            'title.required' => 'Dars nomi kiritilishi shart.',
            'video_url.url'  => 'Video URL noto\'g\'ri formatda.',
            'file.max'       => 'Fayl hajmi 10MB dan oshmasligi kerak.',
            'file.mimes'     => 'Fayl formati qo\'llab-quvvatlanmaydi.',
        ]);

        // Faylni saqlash
        $filePath = null;
        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('lessons/' . $course->id, 'public');
        }

        // Descriptionni tozalash
        $description = $request->input('description');
        if (empty($description) || trim(strip_tags($description)) === '' || $description === '<p><br></p>') {
            $description = null;
        }

        // Darsni yaratish
        Lesson::create([
            'course_id'   => $course->id,
            'title'       => $validated['title'],
            'description' => $description,
            'video_url'   => $validated['video_url'] ?? null,
            'file_path'   => $filePath,
            'duration'    => $validated['duration'] ?? null,
            'order'       => $validated['order'],
            'status'      => $validated['status'],
        ]);

        return redirect()->route('courses.lessons.index', $course)
            ->with('success', 'Dars muvaffaqiyatli qo\'shildi.');
    }

    /**
     * Display the specified lesson.
     */
    public function show(Course $course, Lesson $lesson)
    {
        /** @var User $user */
        $user = Auth::user();
        abort_unless($user->hasPermissionTo('courses.view'), 403, 'Ruxsat etilmagan.');

        if ($lesson->course_id !== $course->id) {
            abort(404, 'Dars topilmadi.');
        }

        $course->load('teacher');

        $allLessons = $course->lessons()->orderBy('order')->get();
        $currentIndex = $allLessons->search(fn($l) => $l->id === $lesson->id);
        $prevLesson = $allLessons->get($currentIndex - 1);
        $nextLesson = $allLessons->get($currentIndex + 1);

        return view('lessons.show', compact('course', 'lesson', 'allLessons', 'prevLesson', 'nextLesson'));
    }

    /**
     * Show the form for editing the specified lesson.
     */
    public function edit(Course $course, Lesson $lesson)
    {
        /** @var User $user */
        $user = Auth::user();
        abort_unless($user->hasPermissionTo('courses.edit'), 403, 'Ruxsat etilmagan.');

        if ($lesson->course_id !== $course->id) {
            abort(404, 'Dars topilmadi.');
        }

        return view('lessons.edit', compact('course', 'lesson'));
    }

    /**
     * Update the specified lesson.
     */
    public function update(Request $request, Course $course, Lesson $lesson)
    {
        /** @var User $user */
        $user = Auth::user();
        abort_unless($user->hasPermissionTo('courses.edit'), 403, 'Ruxsat etilmagan.');

        if ($lesson->course_id !== $course->id) {
            abort(404, 'Dars topilmadi.');
        }

        $validated = $request->validate([
            'title'       => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'video_url'   => ['nullable', 'url'],
            'file'        => ['nullable', 'file', 'max:10240', 'mimes:pdf,doc,docx,ppt,pptx'],
            'duration'    => ['nullable', 'integer', 'min:1'],
            'order'       => ['required', 'integer', 'min:1'],
            'status'      => ['required', 'in:active,inactive'],
        ], [
            'title.required' => 'Dars nomi kiritilishi shart.',
            'video_url.url'  => 'Video URL noto\'g\'ri formatda.',
            'file.max'       => 'Fayl hajmi 10MB dan oshmasligi kerak.',
            'file.mimes'     => 'Fayl formati qo\'llab-quvvatlanmaydi.',
        ]);

        // Faylni yangilash
        if ($request->hasFile('file')) {
            // Eski faylni o'chirish
            if ($lesson->file_path && Storage::disk('public')->exists($lesson->file_path)) {
                Storage::disk('public')->delete($lesson->file_path);
            }
            // Yangi faylni saqlash
            $validated['file_path'] = $request->file('file')->store('lessons/' . $course->id, 'public');
        }

        // Descriptionni tozalash
        $description = $request->input('description');
        if (empty($description) || trim(strip_tags($description)) === '' || $description === '<p><br></p>') {
            $description = null;
        }

        // Yangilanishi kerak bo'lgan ma'lumotlar
        $updateData = [
            'title'       => $validated['title'],
            'description' => $description,
            'video_url'   => $validated['video_url'] ?? null,
            'duration'    => $validated['duration'] ?? null,
            'order'       => $validated['order'],
            'status'      => $validated['status'],
        ];

        // Fayl mavjud bo'lsa qo'shish
        if (isset($validated['file_path'])) {
            $updateData['file_path'] = $validated['file_path'];
        }

        $lesson->update($updateData);

        return redirect()->route('courses.lessons.index', $course)
            ->with('success', 'Dars muvaffaqiyatli yangilandi.');
    }

    /**
     * Remove the specified lesson.
     */
    public function destroy(Course $course, Lesson $lesson)
    {
        /** @var User $user */
        $user = Auth::user();
        abort_unless($user->hasPermissionTo('courses.delete'), 403, 'Ruxsat etilmagan.');

        if ($lesson->course_id !== $course->id) {
            abort(404, 'Dars topilmadi.');
        }

        // Faylni o'chirish
        if ($lesson->file_path && Storage::disk('public')->exists($lesson->file_path)) {
            Storage::disk('public')->delete($lesson->file_path);
        }

        $lesson->delete();

        return redirect()->route('courses.lessons.index', $course)
            ->with('success', 'Dars muvaffaqiyatli o\'chirildi.');
    }
}
