@extends('layouts.dashboard')

@section('title', 'Yangi foydalanuvchi yaratish')
@section('header_title', 'Foydalanuvchilar / Yaratish')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="mb-6">
        <a href="{{ route('admin.users.index') }}" class="inline-flex items-center text-sm font-medium text-slate-400 hover:text-white transition-colors mb-2">
            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Ortga qaytish
        </a>
        <h2 class="text-2xl font-bold text-white">Yangi foydalanuvchi qo'shish</h2>
    </div>

    <div class="bg-slate-800/50 border border-white/5 rounded-2xl backdrop-blur-sm p-6 sm:p-8">
        <form action="{{ route('admin.users.store') }}" method="POST" class="space-y-6">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="name" class="block text-sm font-semibold text-slate-300 mb-2">To'liq ism <span class="text-rose-500">*</span></label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}" class="w-full bg-slate-900/50 border border-white/10 rounded-xl px-4 py-3 text-white placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all" placeholder="Ism va familiya" required>
                    @error('name') <p class="text-rose-400 text-xs mt-2">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="email" class="block text-sm font-semibold text-slate-300 mb-2">Elektron pochta <span class="text-rose-500">*</span></label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" class="w-full bg-slate-900/50 border border-white/10 rounded-xl px-4 py-3 text-white placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all" placeholder="misol@email.uz" required>
                    @error('email') <p class="text-rose-400 text-xs mt-2">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="password" class="block text-sm font-semibold text-slate-300 mb-2">Parol <span class="text-rose-500">*</span></label>
                    <input type="password" id="password" name="password" class="w-full bg-slate-900/50 border border-white/10 rounded-xl px-4 py-3 text-white placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all" placeholder="Parol kiriting" required>
                    @error('password') <p class="text-rose-400 text-xs mt-2">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="password_confirmation" class="block text-sm font-semibold text-slate-300 mb-2">Parolni tasdiqlash <span class="text-rose-500">*</span></label>
                    <input type="password" id="password_confirmation" name="password_confirmation" class="w-full bg-slate-900/50 border border-white/10 rounded-xl px-4 py-3 text-white placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all" placeholder="Parolni takrorlang" required>
                </div>
            </div>

            <div class="pt-4 border-t border-white/5">
                <label class="block text-sm font-semibold text-slate-300 mb-4">Foydalanuvchi roli (Role) <span class="text-rose-500">*</span></label>
                @error('roles') <p class="text-rose-400 text-xs mb-4">{{ $message }}</p> @enderror

                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
                    @foreach($roles as $role)
                    <label class="flex items-center gap-3 p-4 bg-slate-900/40 border border-white/5 rounded-xl cursor-pointer group hover:bg-slate-900/60 transition-colors">
                        <div class="relative flex items-center">
                            <input type="checkbox" name="roles[]" value="{{ $role->name }}" class="peer h-5 w-5 cursor-pointer appearance-none rounded border border-slate-600 bg-slate-800 checked:border-blue-500 checked:bg-blue-500 transition-all" @if(is_array(old('roles')) && in_array($role->name, old('roles'))) checked @endif>
                            <svg class="absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 w-3.5 h-3.5 pointer-events-none opacity-0 peer-checked:opacity-100 text-white" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path>
                            </svg>
                        </div>
                        <span class="text-sm font-medium text-slate-300 group-hover:text-white transition-colors">
                            {{ ucfirst($role->name) }}
                        </span>
                    </label>
                    @endforeach
                </div>
            </div>

            <div class="flex items-center justify-end gap-4 pt-6 border-t border-white/5">
                <a href="{{ route('admin.users.index') }}" class="px-6 py-2.5 rounded-xl text-sm font-medium text-slate-300 hover:text-white hover:bg-slate-700 transition-colors">
                    Bekor qilish
                </a>
                <button type="submit" class="bg-blue-600 hover:bg-blue-500 text-white px-6 py-2.5 rounded-xl text-sm font-medium transition-colors shadow-lg shadow-blue-500/30">
                    Saqlash va qo'shish
                </button>
            </div>
        </form>
    </div>
</div>
@endsection