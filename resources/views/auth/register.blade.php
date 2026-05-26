@extends('layouts.auth')

@section('title', 'Ro\'yxatdan o\'tish')

@section('content')

{{-- Auth Section Container --}}
<section class="flex-grow relative flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8 bg-gradient-to-br from-slate-900 via-blue-900 to-slate-900 overflow-hidden">

    {{-- Background Pattern & Blobs --}}
    <div class="absolute inset-0 opacity-10 pointer-events-none">
        <div class="absolute top-0 left-0 w-full h-full" style="background-image: radial-gradient(circle at 25px 25px, white 2%, transparent 0%); background-size: 50px 50px;"></div>
    </div>
    <div class="absolute top-0 right-1/4 w-72 h-72 bg-emerald-500/20 rounded-full blur-3xl animate-pulse pointer-events-none"></div>
    <div class="absolute bottom-0 left-1/4 w-72 h-72 bg-blue-500/20 rounded-full blur-3xl animate-pulse pointer-events-none" style="animation-delay: 1.5s;"></div>

    {{-- Glassmorphism Card --}}
    <div class="w-full max-w-2xl relative z-10">

        {{-- Back to Home Link --}}
        <div class="mb-6 text-center">
            <a href="/" class="inline-flex items-center gap-2 text-sm font-medium text-slate-400 hover:text-white transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Bosh sahifaga qaytish
            </a>
        </div>

        <div class="bg-white/10 backdrop-blur-xl rounded-3xl shadow-2xl border border-white/10 p-8 sm:p-10">

            {{-- Header --}}
            <div class="text-center mb-8">
                <div class="w-16 h-16 bg-gradient-to-br from-emerald-400 to-emerald-600 rounded-2xl flex items-center justify-center mx-auto mb-6 shadow-lg shadow-emerald-500/30">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                    </svg>
                </div>
                <h1 class="text-3xl font-extrabold text-white tracking-tight">Hisob yaratish</h1>
                <p class="mt-2 text-sm text-slate-300">Platformada ro'yxatdan o'tish uchun ma'lumotlarni to'ldiring</p>
            </div>

            {{-- Form --}}
            <form class="space-y-5">

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                    {{-- First Name Input --}}
                    <div>
                        <label for="first_name" class="block text-sm font-semibold text-slate-200 mb-2">Ism</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                            </div>
                            <input type="text" id="first_name" name="first_name" placeholder="Ismingiz" class="block w-full pl-11 pr-4 py-3.5 bg-slate-900/50 border border-white/10 rounded-xl text-sm text-white placeholder-slate-400 focus:ring-2 focus:ring-emerald-400 focus:border-emerald-400 outline-none transition-all duration-300 hover:border-white/20" />
                        </div>
                    </div>

                    {{-- Last Name Input --}}
                    <div>
                        <label for="last_name" class="block text-sm font-semibold text-slate-200 mb-2">Familiya</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                            </div>
                            <input type="text" id="last_name" name="last_name" placeholder="Familiyangiz" class="block w-full pl-11 pr-4 py-3.5 bg-slate-900/50 border border-white/10 rounded-xl text-sm text-white placeholder-slate-400 focus:ring-2 focus:ring-emerald-400 focus:border-emerald-400 outline-none transition-all duration-300 hover:border-white/20" />
                        </div>
                    </div>
                </div>

                {{-- Email Input --}}
                <div>
                    <label for="email" class="block text-sm font-semibold text-slate-200 mb-2">Elektron pochta</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <input type="email" id="email" name="email" placeholder="sizning@email.uz" class="block w-full pl-11 pr-4 py-3.5 bg-slate-900/50 border border-white/10 rounded-xl text-sm text-white placeholder-slate-400 focus:ring-2 focus:ring-emerald-400 focus:border-emerald-400 outline-none transition-all duration-300 hover:border-white/20" />
                    </div>
                </div>

                {{-- Phone Input --}}
                <div>
                    <label for="phone" class="block text-sm font-semibold text-slate-200 mb-2">Telefon raqam</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                            </svg>
                        </div>
                        <input type="tel" id="phone" name="phone" placeholder="+998 90 123 45 67" class="block w-full pl-11 pr-4 py-3.5 bg-slate-900/50 border border-white/10 rounded-xl text-sm text-white placeholder-slate-400 focus:ring-2 focus:ring-emerald-400 focus:border-emerald-400 outline-none transition-all duration-300 hover:border-white/20" />
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                    {{-- Password Input --}}
                    <div>
                        <label for="password" class="block text-sm font-semibold text-slate-200 mb-2">Parol</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                </svg>
                            </div>
                            <input type="password" id="password" name="password" placeholder="Parol yarating" class="block w-full pl-11 pr-4 py-3.5 bg-slate-900/50 border border-white/10 rounded-xl text-sm text-white placeholder-slate-400 focus:ring-2 focus:ring-emerald-400 focus:border-emerald-400 outline-none transition-all duration-300 hover:border-white/20" />
                        </div>
                    </div>

                    {{-- Confirm Password Input --}}
                    <div>
                        <label for="password_confirmation" class="block text-sm font-semibold text-slate-200 mb-2">Parolni tasdiqlash</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                </svg>
                            </div>
                            <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Parolni takrorlang" class="block w-full pl-11 pr-4 py-3.5 bg-slate-900/50 border border-white/10 rounded-xl text-sm text-white placeholder-slate-400 focus:ring-2 focus:ring-emerald-400 focus:border-emerald-400 outline-none transition-all duration-300 hover:border-white/20" />
                        </div>
                    </div>
                </div>

                {{-- User Type Selection --}}
                <div>
                    <label class="block text-sm font-semibold text-slate-200 mb-3">Siz kim sifatida ro'yxatdan o'tmoqchisiz?</label>
                    <div class="grid grid-cols-2 gap-4">
                        <label class="relative flex items-center gap-3 p-4 border border-white/10 bg-slate-900/30 rounded-xl cursor-pointer hover:border-blue-400/50 transition-all duration-200 has-[:checked]:border-blue-400 has-[:checked]:bg-blue-900/20 group">
                            <input type="radio" name="user_type" value="student" class="sr-only" checked />
                            <div class="w-10 h-10 bg-blue-500/20 rounded-lg flex items-center justify-center group-has-[:checked]:bg-blue-500/40 transition-colors">
                                <svg class="w-5 h-5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                </svg>
                            </div>
                            <div>
                                <span class="block text-sm font-bold text-white">O'quvchi</span>
                                <span class="block text-xs text-slate-400">Kurslarda o'qish uchun</span>
                            </div>
                        </label>

                        <label class="relative flex items-center gap-3 p-4 border border-white/10 bg-slate-900/30 rounded-xl cursor-pointer hover:border-emerald-400/50 transition-all duration-200 has-[:checked]:border-emerald-400 has-[:checked]:bg-emerald-900/20 group">
                            <input type="radio" name="user_type" value="teacher" class="sr-only" />
                            <div class="w-10 h-10 bg-emerald-500/20 rounded-lg flex items-center justify-center group-has-[:checked]:bg-emerald-500/40 transition-colors">
                                <svg class="w-5 h-5 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                            </div>
                            <div>
                                <span class="block text-sm font-bold text-white">O'qituvchi</span>
                                <span class="block text-xs text-slate-400">Kurslar yaratish uchun</span>
                            </div>
                        </label>
                    </div>
                </div>

                {{-- Terms Checkbox --}}
                <div class="flex items-start gap-3">
                    <input type="checkbox" id="terms" name="terms" class="mt-1 h-4 w-4 bg-slate-900 border-white/20 text-emerald-400 focus:ring-emerald-400 rounded transition-colors" />
                    <label for="terms" class="text-sm text-slate-300">
                        Men <a href="/terms" class="text-emerald-400 hover:text-emerald-300 font-bold">foydalanish shartlari</a> va <a href="/privacy" class="text-emerald-400 hover:text-emerald-300 font-bold">maxfiylik siyosati</a> bilan tanishib chiqdim va roziman
                    </label>
                </div>

                {{-- Submit Button --}}
                <button type="submit" class="w-full flex justify-center items-center gap-2 px-6 py-4 bg-gradient-to-r from-emerald-400 to-blue-400 hover:from-emerald-300 hover:to-blue-300 text-slate-900 font-bold rounded-xl shadow-lg shadow-emerald-500/20 transition-all duration-300 hover:scale-[1.02] active:scale-95">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                    </svg>
                    Ro'yxatdan o'tish
                </button>

            </form>

            {{-- Divider --}}
            <div class="mt-8 mb-6 flex items-center gap-3">
                <div class="flex-1 h-px bg-white/10"></div>
                <span class="text-xs text-slate-400 font-medium uppercase tracking-wider">yoki</span>
                <div class="flex-1 h-px bg-white/10"></div>
            </div>

            {{-- Social Register Buttons --}}
            <div class="space-y-3">
                <button type="button" class="w-full flex items-center justify-center gap-3 px-6 py-3.5 bg-white/5 border border-white/10 hover:bg-white/10 rounded-xl text-sm font-medium text-white transition-all duration-300">
                    <svg class="w-5 h-5" viewBox="0 0 24 24">
                        <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92a5.06 5.06 0 01-2.2 3.32v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.1z" />
                        <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" />
                        <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" />
                        <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" />
                    </svg>
                    Google orqali ro'yxatdan o'tish
                </button>

                <button type="button" class="w-full flex items-center justify-center gap-3 px-6 py-3.5 bg-white/5 border border-white/10 hover:bg-white/10 rounded-xl text-sm font-medium text-white transition-all duration-300">
                    <svg class="w-5 h-5 text-blue-400" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" />
                    </svg>
                    Facebook orqali ro'yxatdan o'tish
                </button>
            </div>

            {{-- Login Link --}}
            <p class="mt-8 text-center text-sm text-slate-300">
                Hisobingiz bormi?
                <a href="/login" class="font-bold text-blue-400 hover:text-blue-300 transition-colors ml-1">
                    Tizimga kirish
                </a>
            </p>

        </div>
    </div>
</section>

@endsection