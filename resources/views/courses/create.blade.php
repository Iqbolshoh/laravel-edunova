@extends('layouts.dashboard')

@section('title', 'Yangi kurs yaratish')
@section('header_title', 'Kurslar / Yaratish')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="mb-6">
        <a href="{{ route('courses.index') }}"
            class="inline-flex items-center text-sm font-medium text-slate-400 hover:text-white transition-colors mb-2">
            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18">
                </path>
            </svg>
            Ortga qaytish
        </a>
        <h2 class="text-2xl font-bold text-white">Yangi kurs qo'shish</h2>
    </div>

    <div class="bg-slate-800/50 border border-white/5 rounded-2xl backdrop-blur-sm p-6 sm:p-8">
        <form action="{{ route('courses.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            {{-- Kurs rasmi --}}
            <div>
                <label class="block text-sm font-semibold text-slate-300 mb-2">Kurs rasmi</label>
                <div x-data="{
                            preview: null,
                            showPreview(image) {
                                const reader = new FileReader();
                                reader.onload = (e) => this.preview = e.target.result;
                                reader.readAsDataURL(image);
                            }
                        }" class="space-y-3">
                    <label
                        class="flex flex-col items-center justify-center w-full h-40 border-2 border-dashed border-white/10 rounded-xl cursor-pointer hover:border-blue-500/50 transition-colors bg-slate-900/50">
                        <template x-if="!preview">
                            <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                <svg class="w-10 h-10 text-slate-500 mb-3" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                <p class="text-sm text-slate-400">Rasm yuklash uchun bosing</p>
                                <p class="text-xs text-slate-500 mt-1">PNG, JPG, GIF, WebP (max. 2MB)</p>
                            </div>
                        </template>
                        <template x-if="preview">
                            <div class="relative w-full h-full">
                                <img :src="preview" class="w-full h-40 object-cover rounded-xl" alt="Preview" />
                            </div>
                        </template>
                        <input type="file" name="image" accept="image/*" class="hidden"
                            @change="showPreview($event.target.files[0])" />
                    </label>
                </div>
                @error('image')
                <p class="text-rose-400 text-xs mt-1.5">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="title" class="block text-sm font-semibold text-slate-300 mb-2">Kurs nomi <span
                        class="text-rose-500">*</span></label>
                <input type="text" id="title" name="title" value="{{ old('title') }}"
                    class="w-full bg-slate-900/50 border border-white/10 rounded-xl px-4 py-3 text-white placeholder-slate-500 focus:ring-2 focus:ring-blue-500 outline-none transition-all @error('title') border-rose-500/50 @enderror"
                    placeholder="Kurs nomini kiriting" required />
                @error('title')
                <p class="text-rose-400 text-xs mt-1.5">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="description" class="block text-sm font-semibold text-slate-300 mb-2">Tavsif</label>
                <textarea id="description" name="description" rows="4"
                    class="w-full bg-slate-900/50 border border-white/10 rounded-xl px-4 py-3 text-white placeholder-slate-500 focus:ring-2 focus:ring-blue-500 outline-none transition-all"
                    placeholder="Kurs haqida qisqacha...">{{ old('description') }}</textarea>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label for="price" class="block text-sm font-semibold text-slate-300 mb-2">Narx (so'm)</label>
                    <input type="number" id="price" name="price" value="{{ old('price', 0) }}"
                        class="w-full bg-slate-900/50 border border-white/10 rounded-xl px-4 py-3 text-white focus:ring-2 focus:ring-blue-500 outline-none transition-all" />
                </div>
                <div>
                    <label for="duration" class="block text-sm font-semibold text-slate-300 mb-2">Davomiylik
                        (soat)</label>
                    <input type="number" id="duration" name="duration" value="{{ old('duration') }}"
                        class="w-full bg-slate-900/50 border border-white/10 rounded-xl px-4 py-3 text-white focus:ring-2 focus:ring-blue-500 outline-none transition-all" />
                </div>
            </div>

            <div>
                <label for="status" class="block text-sm font-semibold text-slate-300 mb-2">Holati <span
                        class="text-rose-500">*</span></label>
                <select id="status" name="status"
                    class="w-full bg-slate-900/50 border border-white/10 rounded-xl px-4 py-3 text-white focus:ring-2 focus:ring-blue-500 outline-none transition-all"
                    required>
                    <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>Qoralama</option>
                    <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Faol</option>
                    <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Nofaol</option>
                </select>
            </div>

            <div class="flex items-center justify-end gap-4 pt-6 border-t border-white/5">
                <a href="{{ route('courses.index') }}"
                    class="px-6 py-2.5 rounded-xl text-sm font-medium text-slate-300 hover:text-white hover:bg-slate-700 transition-colors">
                    Bekor qilish
                </a>
                <button type="submit"
                    class="bg-blue-600 hover:bg-blue-500 text-white px-6 py-2.5 rounded-xl text-sm font-medium transition-colors shadow-lg shadow-blue-500/30">
                    Saqlash
                </button>
            </div>
        </form>
    </div>
</div>
@endsection