@extends('layouts.dashboard')

@section('title', $lesson->title)
@section('header_title', $course->title . ' / Darslar')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">

    {{-- Navigation --}}
    <div class="flex items-center justify-between">
        <a href="{{ route('courses.lessons.index', $course) }}" class="inline-flex items-center text-sm font-medium text-slate-400 hover:text-white transition-colors">
            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Barcha darslar
        </a>
        <div class="flex items-center gap-2">
            @if($prevLesson)
            <a href="{{ route('courses.lessons.show', [$course, $prevLesson]) }}" class="bg-slate-800 hover:bg-slate-700 text-slate-300 px-4 py-2 rounded-lg text-sm transition-colors flex items-center gap-1">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
                Oldingi
            </a>
            @endif
            @if($nextLesson)
            <a href="{{ route('courses.lessons.show', [$course, $nextLesson]) }}" class="bg-slate-800 hover:bg-slate-700 text-slate-300 px-4 py-2 rounded-lg text-sm transition-colors flex items-center gap-1">
                Keyingi
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </a>
            @endif
        </div>
    </div>

    {{-- Lesson Content --}}
    <div class="bg-slate-800/50 border border-white/5 rounded-2xl p-8 backdrop-blur-sm">
        <div class="flex items-center gap-3 mb-6">
            <span class="w-10 h-10 bg-blue-500/10 rounded-lg flex items-center justify-center text-blue-400 font-bold text-sm">
                {{ $lesson->order }}
            </span>
            <div>
                <h1 class="text-xl font-bold text-white">{{ $lesson->title }}</h1>
                @if($lesson->duration)
                <p class="text-sm text-slate-500">{{ $lesson->duration }} daqiqa</p>
                @endif
            </div>
        </div>

        @if($lesson->description)
        <div class="text-slate-300 leading-relaxed mb-6">
            {{ $lesson->description }}
        </div>
        @endif

        {{-- Video --}}
        @if($lesson->video_url)
        <div class="mb-6">
            <h3 class="text-lg font-semibold text-white mb-3">Video dars</h3>
            <div class="aspect-video bg-slate-900 rounded-xl overflow-hidden">
                <iframe src="{{ $lesson->video_url }}" class="w-full h-full" frameborder="0" allowfullscreen></iframe>
            </div>
        </div>
        @endif

        {{-- File Download --}}
        @if($lesson->file_path)
        <div>
            <h3 class="text-lg font-semibold text-white mb-3">Yuklab olish</h3>
            <a href="{{ asset('storage/' . $lesson->file_path) }}" class="inline-flex items-center gap-2 bg-blue-500/10 hover:bg-blue-500/20 text-blue-400 px-4 py-3 rounded-xl transition-colors" download>
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
                Faylni yuklab olish
            </a>
        </div>
        @endif
    </div>
</div>
@endsection