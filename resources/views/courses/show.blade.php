@extends('layouts.dashboard')

@section('title', $course->title)
@section('header_title', 'Kurs tafsiloti')

@section('content')
<div class="max-w-5xl mx-auto space-y-6">

    {{-- Success/Error Messages --}}
    @if (session('success'))
    <div x-data="{ show: true }" x-show="show" class="flex items-center justify-between bg-emerald-500/10 border border-emerald-500/20 rounded-xl p-4 text-emerald-400">
        <div class="flex items-center gap-3">
            <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <span class="text-sm font-medium">{{ session('success') }}</span>
        </div>
        <button @click="show = false" class="text-emerald-400 hover:text-emerald-300">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>
    @endif

    @if (session('error'))
    <div x-data="{ show: true }" x-show="show" class="flex items-center justify-between bg-rose-500/10 border border-rose-500/20 rounded-xl p-4 text-rose-400">
        <div class="flex items-center gap-3">
            <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <span class="text-sm font-medium">{{ session('error') }}</span>
        </div>
        <button @click="show = false" class="text-rose-400 hover:text-rose-300">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>
    @endif

    {{-- Back Button --}}
    <a href="{{ route('courses.index') }}" class="inline-flex items-center text-sm font-medium text-slate-400 hover:text-white transition-colors">
        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
        </svg>
        Kurslarga qaytish
    </a>

    {{-- Course Header Card --}}
    <div class="bg-slate-800/50 border border-white/5 rounded-2xl overflow-hidden backdrop-blur-sm">
        {{-- Course Image --}}
        <div class="h-64 sm:h-80 bg-slate-700/50 overflow-hidden">
            @if($course->image)
            <img src="{{ asset('storage/' . $course->image) }}" alt="{{ $course->title }}" class="w-full h-full object-cover" />
            @else
            <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-blue-500/20 to-emerald-500/20">
                <svg class="w-20 h-20 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253"></path>
                </svg>
            </div>
            @endif
        </div>

        {{-- Course Info --}}
        <div class="p-8">
            <div class="flex items-start justify-between gap-4 mb-4">
                <div>
                    <h1 class="text-2xl font-bold text-white mb-2">{{ $course->title }}</h1>
                    <div class="flex items-center gap-3 text-sm text-slate-400">
                        <span class="flex items-center gap-1">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                            {{ $course->teacher->name ?? 'Noma\'lum' }}
                        </span>
                        <span>•</span>
                        <span class="flex items-center gap-1">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            {{ $course->created_at->format('d.m.Y') }}
                        </span>
                    </div>
                </div>
                <span class="text-xs px-3 py-1 rounded-full font-medium
                    @if($course->status === 'active') bg-emerald-500/10 text-emerald-400 border border-emerald-500/20
                    @elseif($course->status === 'inactive') bg-rose-500/10 text-rose-400 border border-rose-500/20
                    @else bg-slate-500/10 text-slate-400 border border-slate-500/20
                    @endif">
                    @if($course->status === 'active') Faol
                    @elseif($course->status === 'inactive') Nofaol
                    @else Qoralama
                    @endif
                </span>
            </div>

            <p class="text-slate-300 leading-relaxed mb-6">
                {{ $course->description ?? 'Kurs tavsifi mavjud emas.' }}
            </p>

            {{-- Stats Row --}}
            <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 mb-6">
                <div class="bg-slate-900/50 rounded-xl p-4 text-center">
                    <span class="text-2xl font-bold text-white block">{{ $course->students_count ?? 0 }}</span>
                    <span class="text-xs text-slate-500">O'quvchilar</span>
                </div>
                <div class="bg-slate-900/50 rounded-xl p-4 text-center">
                    <span class="text-2xl font-bold text-white block">{{ $course->duration ?? '-' }}</span>
                    <span class="text-xs text-slate-500">Soat</span>
                </div>
                <div class="bg-slate-900/50 rounded-xl p-4 text-center">
                    <span class="text-2xl font-bold text-white block">{{ $course->assignments->count() }}</span>
                    <span class="text-xs text-slate-500">Vazifalar</span>
                </div>
                <div class="bg-slate-900/50 rounded-xl p-4 text-center">
                    <span class="text-2xl font-bold text-white block">
                        @if($course->price > 0)
                        {{ number_format($course->price) }}
                        @else
                        Bepul
                        @endif
                    </span>
                    <span class="text-xs text-slate-500">Narx</span>
                </div>
            </div>

            {{-- Action Buttons --}}
            <div class="flex items-center gap-3">
                @can('courses.enroll')
                @if(!auth()->user()->hasRole('teacher'))
                @if(!auth()->user()->enrolledCourses->contains($course->id))
                <form action="{{ route('courses.enroll', $course) }}" method="POST">
                    @csrf
                    <button type="submit" class="bg-emerald-600 hover:bg-emerald-500 text-white px-6 py-2.5 rounded-xl font-medium transition-colors shadow-lg shadow-emerald-500/30">
                        Kursga yozilish
                    </button>
                </form>
                @else
                <span class="bg-emerald-500/10 text-emerald-400 px-6 py-2.5 rounded-xl font-medium border border-emerald-500/20">
                    Siz yozilgansiz
                </span>
                @endif
                @endif
                @endcan

                @can('courses.edit')
                @if(auth()->user()->hasRole('teacher') && $course->teacher_id === auth()->id())
                <a href="{{ route('courses.edit', $course) }}" class="bg-amber-500/10 hover:bg-amber-500/20 text-amber-400 px-4 py-2.5 rounded-xl font-medium transition-colors border border-amber-500/20">
                    Tahrirlash
                </a>
                @endif
                @endcan
            </div>
        </div>
    </div>

    {{-- Assignments Section --}}
    @if($course->assignments->count() > 0)
    <div class="bg-slate-800/50 border border-white/5 rounded-2xl p-8 backdrop-blur-sm">
        <h2 class="text-lg font-semibold text-white mb-6 flex items-center gap-2">
            <svg class="w-5 h-5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
            </svg>
            Vazifalar ({{ $course->assignments->count() }})
        </h2>
        <div class="space-y-3">
            @foreach($course->assignments as $assignment)
            <div class="bg-slate-900/50 rounded-xl p-4 border border-white/5 hover:border-blue-500/20 transition-colors">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-white font-medium">{{ $assignment->title }}</h3>
                        @if($assignment->due_date)
                        <p class="text-xs text-slate-500 mt-1">
                            Muddat: {{ $assignment->due_date->format('d.m.Y H:i') }}
                        </p>
                        @endif
                    </div>
                    <span class="text-xs px-2 py-1 rounded-full font-medium
                        @if($assignment->status === 'active') bg-emerald-500/10 text-emerald-400
                        @else bg-rose-500/10 text-rose-400
                        @endif">
                        {{ $assignment->status === 'active' ? 'Faol' : 'Yopilgan' }}
                    </span>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endif

    {{-- Students Section (faqat o'qituvchiga) --}}
    @if(auth()->user()->hasRole('teacher') && $course->teacher_id === auth()->id() && $course->students->count() > 0)
    <div class="bg-slate-800/50 border border-white/5 rounded-2xl p-8 backdrop-blur-sm">
        <h2 class="text-lg font-semibold text-white mb-6 flex items-center gap-2">
            <svg class="w-5 h-5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
            </svg>
            O'quvchilar ({{ $course->students->count() }})
        </h2>
        <div class="space-y-3">
            @foreach($course->students as $student)
            <div class="flex items-center justify-between bg-slate-900/50 rounded-xl p-4 border border-white/5">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-blue-500/10 rounded-lg flex items-center justify-center text-blue-400 font-bold text-sm">
                        {{ substr($student->name, 0, 1) }}
                    </div>
                    <div>
                        <p class="text-white font-medium text-sm">{{ $student->name }}</p>
                        <p class="text-xs text-slate-500">{{ $student->email }}</p>
                    </div>
                </div>
                <div class="text-right">
                    <span class="text-sm text-white font-medium">{{ $student->pivot->progress }}%</span>
                    @if($student->pivot->completed)
                    <span class="text-xs bg-emerald-500/10 text-emerald-400 px-2 py-0.5 rounded-full ml-2">Yakunlangan</span>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endif
</div>
@endsection