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
        <form action="{{ route('courses.lessons.update', [$course, $lesson]) }}" method="POST" enctype="multipart/form-data" id="lessonForm">
            @csrf
            @method('PUT')

            <div class="space-y-6">
                <div>
                    <label for="title" class="block text-sm font-semibold text-slate-300 mb-2">Dars nomi <span class="text-rose-500">*</span></label>
                    <input type="text" id="title" name="title" value="{{ old('title', $lesson->title) }}" class="w-full bg-slate-900/50 border border-white/10 rounded-xl px-4 py-3 text-white focus:ring-2 focus:ring-blue-500 outline-none @error('title') border-rose-500/50 @enderror" placeholder="Dars nomini kiriting" required />
                    @error('title') <p class="text-rose-400 text-xs mt-1.5">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-300 mb-2">Tavsif</label>
                    <div id="editor" style="height: 300px;"></div>
                    <textarea name="description" id="description" class="hidden">{{ old('description', $lesson->description) }}</textarea>
                    @error('description') <p class="text-rose-400 text-xs mt-1.5">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="video_url" class="block text-sm font-semibold text-slate-300 mb-2">Video URL (YouTube)</label>
                    <input type="url" id="video_url" name="video_url" value="{{ old('video_url', $lesson->video_url) }}" class="w-full bg-slate-900/50 border border-white/10 rounded-xl px-4 py-3 text-white focus:ring-2 focus:ring-blue-500 outline-none @error('video_url') border-rose-500/50 @enderror" placeholder="https://youtube.com/watch?v=..." />
                    @error('video_url') <p class="text-rose-400 text-xs mt-1.5">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-300 mb-2">Fayl (PDF, DOC, PPT)</label>
                    @if($lesson->file_path)
                    <p class="text-xs text-slate-500 mb-2">Joriy fayl: <span class="text-blue-400">{{ basename($lesson->file_path) }}</span></p>
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
            </div>
        </form>
    </div>
</div>

<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>

<style>
    .ql-toolbar.ql-snow {
        background-color: #1e293b;
        border: 1px solid rgba(255, 255, 255, 0.1) !important;
        border-radius: 0.75rem 0.75rem 0 0;
    }

    .ql-container.ql-snow {
        background-color: #0f172a;
        border: 1px solid rgba(255, 255, 255, 0.1) !important;
        border-top: none;
        border-radius: 0 0 0.75rem 0.75rem;
        color: white;
        font-size: 14px;
    }

    .ql-editor {
        color: white;
        padding: 15px;
        min-height: 300px;
    }

    .ql-editor.ql-blank::before {
        color: #64748b !important;
        font-style: normal;
    }

    .ql-snow .ql-stroke {
        stroke: #94a3b8;
    }

    .ql-snow .ql-fill {
        fill: #94a3b8;
    }

    .ql-snow button:hover .ql-stroke {
        stroke: #fff;
    }

    .ql-snow button.ql-active .ql-stroke {
        stroke: #3b82f6;
    }

    .ql-snow .ql-picker-label {
        color: #94a3b8;
    }

    .ql-snow .ql-picker-label:hover {
        color: #fff;
    }

    .ql-snow .ql-picker-label.ql-active {
        color: #3b82f6;
    }

    .ql-snow .ql-picker-options {
        background-color: #1e293b;
        border: 1px solid rgba(255, 255, 255, 0.1);
    }

    .ql-snow .ql-picker-item {
        color: #94a3b8;
    }

    .ql-snow .ql-picker-item:hover {
        color: #fff;
        background-color: #334155;
    }
</style>

<script>
    // Quill editor初始化
    var quill = new Quill('#editor', {
        theme: 'snow',
        placeholder: 'Dars haqida...',
        modules: {
            toolbar: [
                ['bold', 'italic', 'underline', 'strike'],
                ['blockquote', 'code-block'],
                [{
                    'header': 1
                }, {
                    'header': 2
                }],
                [{
                    'list': 'ordered'
                }, {
                    'list': 'bullet'
                }],
                [{
                    'color': []
                }, {
                    'background': []
                }],
                ['link', 'image'],
                ['clean']
            ]
        }
    });

    // Eski qiymatni yuklash (edit rejimi yoki validation error)
    var oldDescription = document.getElementById('description').value;
    if (oldDescription && oldDescription.trim() !== '') {
        quill.root.innerHTML = oldDescription;
    }

    // Form submit bo'lganda
    document.getElementById('lessonForm').addEventListener('submit', function(e) {
        var descriptionContent = quill.root.innerHTML;
        document.getElementById('description').value = descriptionContent;
    });
</script>
@endsection