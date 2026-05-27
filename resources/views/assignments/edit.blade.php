@extends('layouts.dashboard')
@section('title', 'Topshiriqni tahrirlash')
@section('header_title', 'Topshiriqni tahrirlash')

@section('content')
<div class="max-w-3xl mx-auto space-y-6">
    <div class="mb-4">
        <a href="{{ route('assignments.index') }}" class="text-sm text-slate-400 hover:text-white flex items-center gap-1">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            Topshiriqlarga qaytish
        </a>
    </div>

    <div class="bg-slate-800/50 border border-white/5 rounded-2xl p-6 sm:p-8 backdrop-blur-sm">
        <form action="{{ route('assignments.update', $assignment) }}" method="POST" enctype="multipart/form-data" id="assignmentForm">
            @csrf
            @method('PUT')

            <div class="space-y-6">
                <div>
                    <label for="title" class="block text-sm font-semibold text-slate-300 mb-2">Topshiriq nomi <span class="text-rose-500">*</span></label>
                    <input type="text" id="title" name="title" value="{{ old('title', $assignment->title) }}" class="w-full bg-slate-900/50 border border-white/10 rounded-xl px-4 py-3 text-white focus:ring-2 focus:ring-blue-500 outline-none @error('title') border-rose-500/50 @enderror" required />
                    @error('title') <p class="text-rose-400 text-xs mt-1.5">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="course_id" class="block text-sm font-semibold text-slate-300 mb-2">Tegishli kurs <span class="text-rose-500">*</span></label>
                    <select id="course_id" name="course_id" class="w-full bg-slate-900/50 border border-white/10 rounded-xl px-4 py-3 text-white focus:ring-2 focus:ring-blue-500 outline-none" required>
                        <option value="" disabled>Kursni tanlang...</option>
                        @foreach($courses as $course)
                        <option value="{{ $course->id }}" {{ old('course_id', $assignment->course_id) == $course->id ? 'selected' : '' }}>{{ $course->title }}</option>
                        @endforeach
                    </select>
                    @error('course_id') <p class="text-rose-400 text-xs mt-1.5">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-300 mb-2">Tavsif (Vazifa sharti) <span class="text-rose-500">*</span></label>
                    <div id="editor" style="height: 250px;"></div>
                    <textarea name="description" id="description" class="hidden">{{ old('description', $assignment->description) }}</textarea>
                    @error('description') <p class="text-rose-400 text-xs mt-1.5">{{ $message }}</p> @enderror
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label for="due_date" class="block text-sm font-semibold text-slate-300 mb-2">Oxirgi muddat <span class="text-rose-500">*</span></label>
                        <input type="datetime-local" id="due_date" name="due_date" value="{{ old('due_date', \Carbon\Carbon::parse($assignment->due_date)->format('Y-m-d\TH:i')) }}" class="w-full bg-slate-900/50 border border-white/10 rounded-xl px-4 py-3 text-white focus:ring-2 focus:ring-blue-500 outline-none" required />
                        @error('due_date') <p class="text-rose-400 text-xs mt-1.5">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label for="max_score" class="block text-sm font-semibold text-slate-300 mb-2">Maksimal ball <span class="text-rose-500">*</span></label>
                        <input type="number" id="max_score" name="max_score" value="{{ old('max_score', $assignment->max_score) }}" class="w-full bg-slate-900/50 border border-white/10 rounded-xl px-4 py-3 text-white focus:ring-2 focus:ring-blue-500 outline-none" min="1" max="100" required />
                        @error('max_score') <p class="text-rose-400 text-xs mt-1.5">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-300 mb-2">Qo'shimcha fayl (ixtiyoriy)</label>
                    @if($assignment->file_path)
                    <div class="mb-3 text-sm text-slate-400">
                        Joriy fayl mavjud. Yangi fayl yuklasangiz, eskisi o'chiriladi.
                    </div>
                    @endif
                    <input type="file" name="file" class="w-full bg-slate-900/50 border border-white/10 rounded-xl px-4 py-3 text-white file:mr-4 file:py-1 file:px-4 file:rounded-lg file:border-0 file:bg-blue-500/20 file:text-blue-400 file:hover:bg-blue-500/30 file:transition-colors" />
                </div>

                <div class="flex items-center justify-end gap-4 pt-6 border-t border-white/5">
                    <a href="{{ route('assignments.index') }}" class="px-6 py-2.5 rounded-xl text-sm font-medium text-slate-300 hover:text-white hover:bg-slate-700 transition-colors">
                        Bekor qilish
                    </a>
                    <button type="submit" class="bg-amber-600 hover:bg-amber-500 text-white px-6 py-2.5 rounded-xl text-sm font-medium transition-colors shadow-lg shadow-amber-500/30">
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
        font-size: 15px;
    }

    .ql-editor {
        color: white;
        padding: 20px;
        min-height: 250px;
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
</style>

<script>
    var quill = new Quill('#editor', {
        theme: 'snow',
        placeholder: 'Topshiriq matnini kiriting...',
        modules: {
            toolbar: [
                ['bold', 'italic', 'underline', 'strike'],
                ['blockquote', 'code-block'],
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
                ['link', 'clean']
            ]
        }
    });

    // Load existing description into Quill editor
    var oldDesc = document.getElementById('description').value;
    if (oldDesc && oldDesc.trim() !== '') {
        quill.root.innerHTML = oldDesc;
    }

    // Update hidden textarea before submitting
    document.getElementById('assignmentForm').addEventListener('submit', function(e) {
        document.getElementById('description').value = quill.root.innerHTML;
    });
</script>
@endsection