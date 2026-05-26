@extends('layouts.lesson')

@section('title', $lesson->title)

@section('content')
<div class="max-w-4xl mx-auto space-y-6">

    {{-- Lesson Content --}}
    <div class="bg-slate-800/50 border border-white/5 rounded-2xl p-8 backdrop-blur-sm">
        @if($lesson->description)
        <div class="text-slate-300 leading-relaxed mb-6">
            {{ $lesson->description }}
        </div>
        @endif

        {{-- Video --}}
        @if($lesson->video_url)
        <div class="mb-6">
            <h3 class="text-lg font-semibold text-white mb-3 flex items-center gap-2">
                <svg class="w-5 h-5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                </svg>
                Video dars
            </h3>
            <div class="aspect-video bg-slate-900 rounded-xl overflow-hidden">
                <iframe src="{{ $lesson->video_url }}" class="w-full h-full" frameborder="0" allowfullscreen allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"></iframe>
            </div>
        </div>
        @endif

        {{-- File Download --}}
        @if($lesson->file_path)
        <div class="bg-slate-900/50 rounded-xl p-5 border border-white/5">
            <h3 class="text-lg font-semibold text-white mb-3 flex items-center gap-2">
                <svg class="w-5 h-5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
                Dars materiallari
            </h3>
            <a href="{{ asset('storage/' . $lesson->file_path) }}"
                class="inline-flex items-center gap-2 bg-blue-500/10 hover:bg-blue-500/20 text-blue-400 px-4 py-3 rounded-xl transition-colors"
                download>
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                </svg>
                Yuklab olish
            </a>
        </div>
        @endif

        {{-- Empty state --}}
        @if(!$lesson->description && !$lesson->video_url && !$lesson->file_path)
        <div class="text-center py-12">
            <div class="w-16 h-16 bg-slate-700/50 rounded-full flex items-center justify-center mx-auto mb-4">
                <svg class="w-8 h-8 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <p class="text-slate-500">Bu dars uchun hozircha kontent qo'shilmagan.</p>
        </div>
        @endif
    </div>
</div>
@endsection