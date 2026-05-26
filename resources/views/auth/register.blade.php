@extends('layouts.app')

@section('title', 'Ro\'yxatdan o\'tish')

@section('content')
<section class="flex-grow relative flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8 bg-gradient-to-br from-slate-900 via-blue-900 to-slate-900 overflow-hidden">
    {{-- Background Blobs --}}
    <div class="absolute inset-0 opacity-10 pointer-events-none">
        <div class="absolute top-0 left-0 w-full h-full" style="background-image: radial-gradient(circle at 25px 25px, white 2%, transparent 0%); background-size: 50px 50px;"></div>
    </div>
    <div class="absolute bottom-0 left-1/4 w-72 h-72 bg-blue-500/20 rounded-full blur-3xl animate-pulse pointer-events-none"></div>

    <div class="w-full max-w-md relative z-10">
        {{-- Back to Home --}}
        <div class="mb-6 text-center">
            <a href="/" class="inline-flex items-center gap-2 text-sm font-medium text-slate-400 hover:text-white transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Bosh sahifaga qaytish
            </a>
        </div>

        <div class="bg-white/10 backdrop-blur-xl rounded-3xl shadow-2xl border border-white/10 p-8 sm:p-10">
            <div class="text-center mb-8">
                <div class="w-16 h-16 bg-gradient-to-br from-emerald-400 to-emerald-600 rounded-2xl flex items-center justify-center mx-auto mb-6 shadow-lg shadow-emerald-500/30">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                    </svg>
                </div>
                <h1 class="text-3xl font-extrabold text-white tracking-tight">Hisob yaratish</h1>
                <p class="mt-2 text-sm text-slate-300">Ma'lumotlaringizni kiriting</p>
            </div>

            <form method="POST" action="{{ route('register.post') }}" class="space-y-4">
                @csrf

                {{-- Ism --}}
                <div>
                    <label for="first_name" class="block text-sm font-semibold text-slate-200 mb-1">Ism</label>
                    <input type="text" id="first_name" name="first_name" value="{{ old('first_name') }}" placeholder="Ismingiz" class="block w-full px-4 py-3 bg-slate-900/50 border border-white/10 rounded-xl text-sm text-white focus:ring-2 focus:ring-emerald-400 outline-none transition-all" required />
                    @error('first_name') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                {{-- Familiya --}}
                <div>
                    <label for="last_name" class="block text-sm font-semibold text-slate-200 mb-1">Familiya</label>
                    <input type="text" id="last_name" name="last_name" value="{{ old('last_name') }}" placeholder="Familiyangiz" class="block w-full px-4 py-3 bg-slate-900/50 border border-white/10 rounded-xl text-sm text-white focus:ring-2 focus:ring-emerald-400 outline-none transition-all" required />
                    @error('last_name') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                {{-- Email --}}
                <div>
                    <label for="email" class="block text-sm font-semibold text-slate-200 mb-1">Elektron pochta</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="email@manzil.uz" class="block w-full px-4 py-3 bg-slate-900/50 border border-white/10 rounded-xl text-sm text-white focus:ring-2 focus:ring-emerald-400 outline-none transition-all" required />
                    @error('email') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                {{-- Parol --}}
                <div>
                    <label for="password" class="block text-sm font-semibold text-slate-200 mb-1">Parol</label>
                    <input type="password" id="password" name="password" placeholder="Parol yarating" class="block w-full px-4 py-3 bg-slate-900/50 border border-white/10 rounded-xl text-sm text-white focus:ring-2 focus:ring-emerald-400 outline-none transition-all" required />
                    @error('password') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                {{-- Parolni tasdiqlash --}}
                <div>
                    <label for="password_confirmation" class="block text-sm font-semibold text-slate-200 mb-1">Parolni tasdiqlash</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Parolni qayta kiriting" class="block w-full px-4 py-3 bg-slate-900/50 border border-white/10 rounded-xl text-sm text-white focus:ring-2 focus:ring-emerald-400 outline-none transition-all" required />
                </div>

                {{-- Terms --}}
                <div class="flex items-start gap-3 py-2">
                    <input type="checkbox" id="terms" name="terms" class="mt-1 h-4 w-4 bg-slate-900 border-white/20 text-emerald-400 rounded" required />
                    <label for="terms" class="text-xs text-slate-300 leading-relaxed">Men shartlarga roziman</label>
                </div>

                <button type="submit" class="w-full flex justify-center items-center px-6 py-4 bg-gradient-to-r from-emerald-400 to-blue-400 hover:from-emerald-300 hover:to-blue-300 text-slate-900 font-bold rounded-xl transition-all active:scale-95 shadow-lg shadow-emerald-500/20">
                    Ro'yxatdan o'tish
                </button>
            </form>

            <p class="mt-6 text-center text-sm text-slate-300">
                Hisobingiz bormi?
                <a href="{{ route('login') }}" class="font-bold text-blue-400 hover:text-blue-300 ml-1 transition-colors">Kirish</a>
            </p>
        </div>
    </div>
</section>
@endsection