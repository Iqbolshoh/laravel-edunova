@extends('layouts.dashboard')

@section('title', $course->title . ' - Darslar')
@section('header_title', 'Darslar')

@section('content')
<div class="space-y-6">

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

    {{-- Header --}}
    <div class="flex items-center justify-between">
        <div>
            <a href="{{ route('courses.show', $course) }}" class="inline-flex items-center text-sm font-medium text-slate-400 hover:text-white transition-colors mb-2">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                {{ $course->title }} ga qaytish
            </a>
            <h2 class="text-2xl font-bold text-white">{{ $course->title }} - Darslar</h2>
            <p class="text-sm text-slate-400 mt-1">{{ $course->lessons->count() }} ta dars</p>
        </div>
        @can('courses.edit')
        @if(auth()->user()->hasRole('teacher') && $course->teacher_id === auth()->id())
        <a href="{{ route('courses.lessons.create', $course) }}" class="inline-flex items-center gap-2 bg-emerald-600 hover:bg-emerald-500 text-white px-5 py-2.5 rounded-xl font-medium transition-colors shadow-lg shadow-emerald-500/30">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
            Yangi dars
        </a>
        @endif
        @endcan
    </div>

    {{-- Lessons List --}}
    @if($course->lessons->count() > 0)
    <div class="space-y-3">
        @foreach($course->lessons as $lesson)
        <div class="bg-slate-800/50 border border-white/5 rounded-xl p-5 hover:border-blue-500/30 transition-all group">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-4">
                    <div class="w-10 h-10 bg-blue-500/10 rounded-lg flex items-center justify-center text-blue-400 font-bold text-sm">
                        {{ $lesson->order }}
                    </div>
                    <div>
                        <h3 class="text-white font-medium group-hover:text-blue-400 transition-colors">
                            {{ $lesson->title }}
                        </h3>
                        <div class="flex items-center gap-3 mt-1 text-xs text-slate-500">
                            @if($lesson->duration)
                            <span class="flex items-center gap-1">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                {{ $lesson->duration }} daq
                            </span>
                            @endif
                            @if($lesson->video_url)
                            <span class="flex items-center gap-1">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                                </svg>
                                Video
                            </span>
                            @endif
                            @if($lesson->file_path)
                            <span class="flex items-center gap-1">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                </svg>
                                Fayl
                            </span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="flex items-center gap-2">
                    <a href="{{ route('courses.lessons.show', [$course, $lesson]) }}" class="bg-slate-700/50 hover:bg-slate-700 text-slate-300 px-4 py-2 rounded-lg text-sm transition-colors">
                        Ko'rish
                    </a>
                    @can('courses.edit')
                    @if(auth()->user()->hasRole('teacher') && $course->teacher_id === auth()->id())
                    <a href="{{ route('courses.lessons.edit', [$course, $lesson]) }}" class="bg-amber-500/10 hover:bg-amber-500/20 text-amber-400 px-3 py-2 rounded-lg text-sm transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                    </a>
                    @endif
                    @endcan
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @else
    <div class="bg-slate-800/50 border border-white/5 rounded-2xl p-12 text-center backdrop-blur-sm">
        <div class="w-20 h-20 bg-slate-700/50 rounded-full flex items-center justify-center mx-auto mb-6">
            <svg class="w-10 h-10 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
            </svg>
        </div>
        <h2 class="text-xl font-semibold text-white mb-2">Hozircha darslar yo'q</h2>
        <p class="text-slate-400 mb-6">Bu kursga hali dars qo'shilmagan.</p>
        @can('courses.edit')
        @if(auth()->user()->hasRole('teacher') && $course->teacher_id === auth()->id())
        <a href="{{ route('courses.lessons.create', $course) }}" class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-500 text-white px-6 py-2.5 rounded-xl font-medium transition-colors">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
            Birinchi darsni qo'shish
        </a>
        @endif
        @endcan
    </div>
    @endif
</div>
@endsection