@extends('layouts.dashboard')

@section('title', 'Kursni tahrirlash')
@section('header_title', 'Kurslar / Tahrirlash')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="mb-6">
        <a href="{{ route('courses.index') }}" class="inline-flex items-center text-sm font-medium text-slate-400 hover:text-white transition-colors mb-2">
            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Ortga qaytish
        </a>
        <h2 class="text-2xl font-bold text-white">Kursni tahrirlash: <span class="text-blue-400">{{ $course->title }}</span></h2>
    </div>

    <div class="bg-slate-800/50 border border-white/5 rounded-2xl backdrop-blur-sm p-6 sm:p-8">
        <form action="{{ route('courses.update', $course) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            {{-- Kurs rasmi --}}
            <div>
                <label class="block text-sm font-semibold text-slate-300 mb-2">Kurs rasmi</label>
                <div x-data="{ 
                    preview: '{{ $course->image ? asset('storage/' . $course->image) : '' }}',
                    hasImage: {{ $course->image ? 'true' : 'false' }},
                    showPreview(image) {
                        const reader = new FileReader();
                        reader.onload = (e) => {
                            this.preview = e.target.result;
                            this.hasImage = true;
                        };
                        reader.readAsDataURL(image);
                    },
                    removeImage() {
                        this.preview = '';
                        this.hasImage = false;
                        this.$refs.fileInput.value = '';
                        this.$refs.removeFlag.value = '1';
                    }
                }" class="space-y-3">
                    {{-- Preview --}}
                    <template x-if="hasImage && preview">
                        <div class="relative w-full h-48 rounded-xl overflow-hidden border border-white/10">
                            <img :src="preview" class="w-full h-full object-cover" alt="Preview" />
                            <button type="button" @click="removeImage()" class="absolute top-3 right-3 bg-rose-500/80 hover:bg-rose-500 text-white p-2 rounded-lg transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                            </button>
                        </div>
                    </template>

                    {{-- Upload area --}}
                    <template x-if="!hasImage || !preview">
                        <label class="flex flex-col items-center justify-center w-full h-40 border-2 border-dashed border-white/10 rounded-xl cursor-pointer hover:border-blue-500/50 transition-colors bg-slate-900/50">
                            <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                <svg class="w-10 h-10 text-slate-500 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                <p class="text-sm text-slate-400">Rasm yuklash uchun bosing</p>
                                <p class="text-xs text-slate-500 mt-1">PNG, JPG, GIF, WebP (max. 2MB)</p>
                            </div>
                            <input type="file" name="image" x-ref="fileInput" accept="image/*" class="hidden" @change="showPreview($event.target.files[0])" />
                        </label>
                    </template>

                    {{-- Joriy rasmni saqlash --}}
                    @if($course->image)
                    <div class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <p class="text-xs text-slate-500">Yangi rasm yuklasangiz, joriy rasm avtomatik almashtiriladi</p>
                    </div>
                    @endif

                    <input type="hidden" name="remove_image" x-ref="removeFlag" value="0" />
                </div>
                @error('image')
                <p class="text-rose-400 text-xs mt-1.5">{{ $message }}</p>
                @enderror
            </div>

            {{-- Kurs nomi --}}
            <div>
                <label for="title" class="block text-sm font-semibold text-slate-300 mb-2">Kurs nomi <span class="text-rose-500">*</span></label>
                <input type="text" id="title" name="title" value="{{ old('title', $course->title) }}" class="w-full bg-slate-900/50 border border-white/10 rounded-xl px-4 py-3 text-white placeholder-slate-500 focus:ring-2 focus:ring-blue-500 outline-none transition-all @error('title') border-rose-500/50 @enderror" placeholder="Kurs nomini kiriting" required />
                @error('title') <p class="text-rose-400 text-xs mt-1.5">{{ $message }}</p> @enderror
            </div>

            {{-- Tavsif --}}
            <div>
                <label for="description" class="block text-sm font-semibold text-slate-300 mb-2">Tavsif</label>
                <textarea id="description" name="description" rows="4" class="w-full bg-slate-900/50 border border-white/10 rounded-xl px-4 py-3 text-white placeholder-slate-500 focus:ring-2 focus:ring-blue-500 outline-none transition-all" placeholder="Kurs haqida qisqacha...">{{ old('description', $course->description) }}</textarea>
            </div>

            {{-- Narx va Davomiylik --}}
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label for="price" class="block text-sm font-semibold text-slate-300 mb-2">Narx (so'm)</label>
                    <input type="number" id="price" name="price" value="{{ old('price', $course->price) }}" class="w-full bg-slate-900/50 border border-white/10 rounded-xl px-4 py-3 text-white focus:ring-2 focus:ring-blue-500 outline-none transition-all" />
                    @error('price') <p class="text-rose-400 text-xs mt-1.5">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label for="duration" class="block text-sm font-semibold text-slate-300 mb-2">Davomiylik (soat)</label>
                    <input type="number" id="duration" name="duration" value="{{ old('duration', $course->duration) }}" class="w-full bg-slate-900/50 border border-white/10 rounded-xl px-4 py-3 text-white focus:ring-2 focus:ring-blue-500 outline-none transition-all" />
                    @error('duration') <p class="text-rose-400 text-xs mt-1.5">{{ $message }}</p> @enderror
                </div>
            </div>

            {{-- Holati --}}
            <div>
                <label for="status" class="block text-sm font-semibold text-slate-300 mb-2">Holati <span class="text-rose-500">*</span></label>
                <select id="status" name="status" class="w-full bg-slate-900/50 border border-white/10 rounded-xl px-4 py-3 text-white focus:ring-2 focus:ring-blue-500 outline-none transition-all @error('status') border-rose-500/50 @enderror" required>
                    <option value="draft" {{ old('status', $course->status) == 'draft' ? 'selected' : '' }}>Qoralama</option>
                    <option value="active" {{ old('status', $course->status) == 'active' ? 'selected' : '' }}>Faol</option>
                    <option value="inactive" {{ old('status', $course->status) == 'inactive' ? 'selected' : '' }}>Nofaol</option>
                </select>
                @error('status') <p class="text-rose-400 text-xs mt-1.5">{{ $message }}</p> @enderror
            </div>

            {{-- Tugmalar --}}
            <div class="flex items-center justify-between pt-6 border-t border-white/5">
                <div class="text-xs text-slate-500">
                    <span class="flex items-center gap-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Yaratilgan: {{ $course->created_at->format('d.m.Y H:i') }}
                    </span>
                    <span class="flex items-center gap-1 mt-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                        </svg>
                        Yangilangan: {{ $course->updated_at->format('d.m.Y H:i') }}
                    </span>
                </div>
                <div class="flex items-center gap-4">
                    <a href="{{ route('courses.index') }}" class="px-6 py-2.5 rounded-xl text-sm font-medium text-slate-300 hover:text-white hover:bg-slate-700 transition-colors">
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
@endsection