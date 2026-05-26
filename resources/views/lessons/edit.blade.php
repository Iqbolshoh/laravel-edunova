@extends('layouts.dashboard')

@section('title', 'Darsni tahrirlash')
@section('header_title', $course->title . ' / Tahrirlash')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="mb-6">
        <a href="{{ route('courses.lessons.index', $course) }}" class="inline-flex items-center text-sm font-medium text-slate-400 hover:text-white transition-colors mb-2">
            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Darslarga qaytish
        </a>
        <h2 class="text-2xl font-bold text-white">Darsni tahrirlash: <span class="text-blue-400">{{ $lesson->title }}</span></h2>
    </div>

    <div class="bg-slate-800/50 border border-white/5 rounded-2xl backdrop-blur-sm p-6 sm:p-8">
        <form action="{{ route('courses.lessons.update', [$course, $lesson]) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            <div>
                <label for="title" class="block text-sm font-semibold text-slate-300 mb-2">Dars nomi <span class="text-rose-500">*</span></label>
                <input type="text" id="title" name="title" value="{{ old('title', $lesson->title) }}" class="w-full bg-slate-900/50 border border-white/10 rounded-xl px-4 py-3 text-white focus:ring-2 focus:ring-blue-500 outline-none @error('title') border-rose-500/50 @enderror" placeholder="Dars nomini kiriting" required />
                @error('title') <p class="text-rose-400 text-xs mt-1.5">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="description" class="block text-sm font-semibold text-slate-300 mb-2">Tavsif</label>
                <textarea id="description" name="description" rows="3" class="w-full bg-slate-900/50 border border-white/10 rounded-xl px-4 py-3 text-white focus:ring-2 focus:ring-blue-500 outline-none" placeholder="Dars haqida...">{{ old('description', $lesson->description) }}</textarea>
            </div>

            <div>
                <label for="video_url" class="block text-sm font-semibold text-slate-300 mb-2">Video URL (YouTube)</label>
                <input type="url" id="video_url" name="video_url" value="{{ old('video_url', $lesson->video_url) }}" class="w-full bg-slate-900/50 border border-white/10 rounded-xl px-4 py-3 text-white focus:ring-2 focus:ring-blue-500 outline-none @error('video_url') border-rose-500/50 @enderror" placeholder="https://youtube.com/watch?v=..." />
                @error('video_url') <p class="text-rose-400 text-xs mt-1.5">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-300 mb-2">Fayl (PDF, DOC, PPT)</label>
                @if($lesson->file_path)
                <p class="text-xs text-slate-500 mb-2">Joriy fayl: {{ basename($lesson->file_path) }}</p>
                @endif
                <input type="file" name="file" class="w-full bg-slate-900/50 border border-white/10 rounded-xl px-4 py-3 text-white file:mr-4 file:py-1 file:px-4 file:rounded-lg file:border-0 file:bg-blue-500/20 file:text-blue-400 file:hover:bg-blue-500/30 file:transition-colors" />
                @error('file') <p class="text-rose-400 text-xs mt-1.5">{{ $message }}</p> @enderror
            </div>

            <div class="grid grid-cols-3 gap-4">
                <div>
                    <label for="order" class="block text-sm font-semibold text-slate-300 mb-2">Tartib raqami</label>
                    <input type="number" id="order" name="order" value="{{ old('order', $lesson->order) }}" class="w-full bg-slate-900/50 border border-white/10 rounded-xl px-4 py-3 text-white focus:ring-2 focus:ring-blue-500 outline-none" required />
                </div>
                <div>
                    <label for="duration" class="block text-sm font-semibold text-slate-300 mb-2">Davomiylik (daq)</label>
                    <input type="number" id="duration" name="duration" value="{{ old('duration', $lesson->duration) }}" class="w-full bg-slate-900/50 border border-white/10 rounded-xl px-4 py-3 text-white focus:ring-2 focus:ring-blue-500 outline-none" />
                </div>
                <div>
                    <label for="status" class="block text-sm font-semibold text-slate-300 mb-2">Holati</label>
                    <select id="status" name="status" class="w-full bg-slate-900/50 border border-white/10 rounded-xl px-4 py-3 text-white focus:ring-2 focus:ring-blue-500 outline-none" required>
                        <option value="active" {{ old('status', $lesson->status) == 'active' ? 'selected' : '' }}>Faol</option>
                        <option value="inactive" {{ old('status', $lesson->status) == 'inactive' ? 'selected' : '' }}>Nofaol</option>
                    </select>
                </div>
            </div>

            <div class="flex items-center justify-end gap-4 pt-6 border-t border-white/5">
                <a href="{{ route('courses.lessons.index', $course) }}" class="px-6 py-2.5 rounded-xl text-sm font-medium text-slate-300 hover:text-white hover:bg-slate-700 transition-colors">
                    Bekor qilish
                </a>
                <button type="submit" class="bg-blue-600 hover:bg-blue-500 text-white px-6 py-2.5 rounded-xl text-sm font-medium transition-colors shadow-lg shadow-blue-500/30">
                    O'zgarishlarni saqlash
                </button>
            </div>
        </form>
    </div>
</div>
@endsection