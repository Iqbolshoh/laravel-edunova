<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CourseController extends Controller
{
    /**
     * Display a listing of the courses.
     */
    public function index()
    {
        /** @var User $user */
        $user = Auth::user();
        abort_unless($user->hasPermissionTo('courses.view'), 403, 'Ruxsat etilmagan.');

        if ($user->hasRole('teacher')) {
            $courses = Course::where('teacher_id', $user->id)
                ->withCount('students')
                ->latest()
                ->paginate(12);
        } else {
            $courses = Course::where('status', 'active')
                ->with('teacher')
                ->latest()
                ->paginate(12);
        }

        return view('courses.index', compact('courses'));
    }

    /**
     * Show the form for creating a new course.
     */
    public function create()
    {
        /** @var User $user */
        $user = Auth::user();
        abort_unless($user->hasPermissionTo('courses.create'), 403, 'Ruxsat etilmagan.');

        return view('courses.create');
    }

    /**
     * Store a newly created course.
     */
    public function store(Request $request)
    {
        /** @var User $user */
        $user = Auth::user();
        abort_unless($user->hasPermissionTo('courses.create'), 403, 'Ruxsat etilmagan.');

        $validated = $request->validate([
            'title'       => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'image'       => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,webp', 'max:2048'],
            'price'       => ['nullable', 'integer', 'min:0'],
            'duration'    => ['nullable', 'integer', 'min:1'],
            'status'      => ['required', 'in:active,inactive,draft'],
        ], [
            'title.required'   => 'Kurs nomi kiritilishi shart.',
            'title.max'        => 'Kurs nomi 255 ta belgidan oshmasligi kerak.',
            'image.image'      => 'Fayl rasm formatida bo\'lishi kerak.',
            'image.mimes'      => 'Rasm jpeg, png, jpg, gif yoki webp formatida bo\'lishi kerak.',
            'image.max'        => 'Rasm hajmi 2MB dan oshmasligi kerak.',
            'price.integer'    => 'Narx butun son bo\'lishi kerak.',
            'price.min'        => 'Narx 0 dan kichik bo\'lmasligi kerak.',
            'duration.integer' => 'Davomiylik butun son bo\'lishi kerak.',
            'status.required'  => 'Status tanlanishi shart.',
            'status.in'        => 'Noto\'g\'ri status tanlandi.',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('courses', 'public');
        }

        Course::create([
            'title'       => $validated['title'],
            'description' => $validated['description'] ?? null,
            'image'       => $imagePath,
            'price'       => $validated['price'] ?? 0,
            'duration'    => $validated['duration'] ?? null,
            'status'      => $validated['status'],
            'teacher_id'  => $user->id,
        ]);

        return redirect()->route('courses.index')
            ->with('success', 'Kurs muvaffaqiyatli yaratildi.');
    }

    /**
     * Display the specified course.
     */
    public function show(Course $course)
    {
        /** @var User $user */
        $user = Auth::user();
        abort_unless($user->hasPermissionTo('courses.view'), 403, 'Ruxsat etilmagan.');

        $course->load(['teacher', 'students']);

        return view('courses.show', compact('course'));
    }

    /**
     * Show the form for editing the specified course.
     */
    public function edit(Course $course)
    {
        /** @var User $user */
        $user = Auth::user();
        abort_unless($user->hasPermissionTo('courses.edit'), 403, 'Ruxsat etilmagan.');

        return view('courses.edit', compact('course'));
    }

    /**
     * Update the specified course.
     */
    public function update(Request $request, Course $course)
    {
        /** @var User $user */
        $user = Auth::user();
        abort_unless($user->hasPermissionTo('courses.edit'), 403, 'Ruxsat etilmagan.');

        $validated = $request->validate([
            'title'       => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'image'       => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,webp', 'max:2048'],
            'price'       => ['nullable', 'integer', 'min:0'],
            'duration'    => ['nullable', 'integer', 'min:1'],
            'status'      => ['required', 'in:active,inactive,draft'],
        ], [
            'title.required'   => 'Kurs nomi kiritilishi shart.',
            'title.max'        => 'Kurs nomi 255 ta belgidan oshmasligi kerak.',
            'image.image'      => 'Fayl rasm formatida bo\'lishi kerak.',
            'image.mimes'      => 'Rasm jpeg, png, jpg, gif yoki webp formatida bo\'lishi kerak.',
            'image.max'        => 'Rasm hajmi 2MB dan oshmasligi kerak.',
            'price.integer'    => 'Narx butun son bo\'lishi kerak.',
            'price.min'        => 'Narx 0 dan kichik bo\'lmasligi kerak.',
            'duration.integer' => 'Davomiylik butun son bo\'lishi kerak.',
            'status.required'  => 'Status tanlanishi shart.',
            'status.in'        => 'Noto\'g\'ri status tanlandi.',
        ]);

        if ($request->hasFile('image')) {
            if ($course->image && Storage::disk('public')->exists($course->image)) {
                Storage::disk('public')->delete($course->image);
            }
            $validated['image'] = $request->file('image')->store('courses', 'public');
        }

        $course->update($validated);

        return redirect()->route('courses.index')
            ->with('success', 'Kurs muvaffaqiyatli yangilandi.');
    }

    /**
     * Remove the specified course.
     */
    public function destroy(Course $course)
    {
        /** @var User $user */
        $user = Auth::user();
        abort_unless($user->hasPermissionTo('courses.delete'), 403, 'Ruxsat etilmagan.');

        if ($course->image && Storage::disk('public')->exists($course->image)) {
            Storage::disk('public')->delete($course->image);
        }

        $course->delete();

        return redirect()->route('courses.index')
            ->with('success', 'Kurs muvaffaqiyatli o\'chirildi.');
    }

    /**
     * Enroll student to course.
     */
    public function enroll(Course $course)
    {
        /** @var User $user */
        $user = Auth::user();
        abort_unless($user->hasPermissionTo('courses.enroll'), 403, 'Ruxsat etilmagan.');

        if ($user->enrolledCourses()->where('course_id', $course->id)->exists()) {
            return back()->with('error', 'Siz allaqachon bu kursga yozilgansiz.');
        }

        $user->enrolledCourses()->attach($course->id, [
            'progress'  => 0,
            'completed' => false,
        ]);

        $course->increment('students_count');

        return back()->with('success', 'Kursga muvaffaqiyatli yozildingiz.');
    }
}
