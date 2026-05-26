@extends('layouts.app')

@section('title', 'Tizimga kirish')

@section('content')
<section class="min-h-screen w-full relative flex flex-col items-center justify-center py-12 px-4 sm:px-6 lg:px-8 bg-gradient-to-br from-slate-900 via-blue-900 to-slate-900 overflow-hidden">

    <div class="absolute inset-0 opacity-10 pointer-events-none">
        <div class="absolute top-0 left-0 w-full h-full" style="background-image: radial-gradient(circle at 25px 25px, white 2%, transparent 0%); background-size: 50px 50px;"></div>
    </div>
    <div class="absolute top-0 left-1/4 w-64 h-64 bg-blue-500/20 rounded-full blur-3xl animate-pulse pointer-events-none"></div>

    <div class="w-full max-w-md relative z-10">

        <div class="mb-6 text-center">
            <a href="/" class="inline-flex items-center gap-2 text-sm font-medium text-slate-400 hover:text-white transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Bosh sahifaga qaytish
            </a>
        </div>

        <div class="bg-slate-800/50 backdrop-blur-xl rounded-3xl shadow-2xl border border-white/10 p-8 sm:p-10">

            <div class="text-center mb-8">
                <div class="w-16 h-16 bg-blue-500 rounded-2xl flex items-center justify-center mx-auto mb-6 shadow-lg shadow-blue-500/30">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                </div>
                <h1 class="text-3xl font-extrabold text-white tracking-tight">Xush kelibsiz</h1>
                <p class="mt-2 text-sm text-slate-300">Hisobingizga kirish uchun ma'lumotlarni kiriting</p>
            </div>

            <form method="POST" action="{{ route('login.post') }}" class="space-y-5">
                @csrf

                <div>
                    <label for="email" class="block text-sm font-semibold text-slate-200 mb-2">Elektron pochta</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                        </span>
                        <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="sizning@email.uz" class="block w-full pl-11 pr-4 py-3.5 bg-slate-900/60 border border-white/5 rounded-xl text-sm text-white focus:ring-2 focus:ring-blue-500 outline-none transition-all" required />
                    </div>
                    @error('email') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="password" class="block text-sm font-semibold text-slate-200 mb-2">Parol</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                            </svg>
                        </span>
                        <input type="password" id="password" name="password" placeholder="Parolingizni kiriting" class="block w-full pl-11 pr-4 py-3.5 bg-slate-900/60 border border-white/5 rounded-xl text-sm text-white focus:ring-2 focus:ring-blue-500 outline-none transition-all" required />
                    </div>
                </div>

                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <input type="checkbox" id="remember" name="remember" class="h-4 w-4 bg-slate-900 border-white/20 text-emerald-400 rounded" />
                        <label for="remember" class="ml-2 block text-sm text-slate-300">Eslab qolish</label>
                    </div>
                    <a href="#" class="text-sm font-medium text-emerald-400 hover:text-emerald-300 transition-colors">Parolni unutdingizmi?</a>
                </div>

                <button type="submit" class="w-full flex justify-center items-center gap-2 px-6 py-4 bg-gradient-to-r from-emerald-400 to-blue-400 hover:from-emerald-300 hover:to-blue-300 text-slate-900 font-bold rounded-xl transition-all active:scale-95 shadow-lg shadow-blue-500/20">
                    Tizimga kirish
                </button>
            </form>

            <p class="mt-8 text-center text-sm text-slate-300">
                Hisobingiz yo'qmi?
                <a href="{{ route('register') }}" class="font-bold text-emerald-400 hover:text-emerald-300 ml-1 transition-colors">Ro'yxatdan o'tish</a>
            </p>
        </div>
    </div>
</section>
@endsection