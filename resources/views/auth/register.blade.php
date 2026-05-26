@extends('layouts.app')

@section('title', 'Ro\'yxatdan o\'tish')

@section('content')
<section x-data="{ showPassword: false, showConfirmation: false }" class="flex-grow relative flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8 bg-gradient-to-br from-slate-900 via-blue-900 to-slate-900 overflow-hidden">
    {{-- Background Blobs --}}
    <div class="absolute inset-0 opacity-10 pointer-events-none">
        <div class="absolute top-0 left-0 w-full h-full" style="background-image: radial-gradient(circle at 25px 25px, white 2%, transparent 0%); background-size: 50px 50px;"></div>
    </div>
    <div class="absolute top-[-10%] left-[-10%] w-96 h-96 bg-blue-500/20 rounded-full blur-3xl animate-pulse pointer-events-none"></div>
    <div class="absolute bottom-[-10%] right-[-10%] w-96 h-96 bg-emerald-500/20 rounded-full blur-3xl animate-pulse pointer-events-none" style="animation-delay: 1s;"></div>

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
                    <label for="first_name" class="block text-sm font-semibold text-slate-200 mb-1.5">Ism</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                        <input type="text" id="first_name" name="first_name" value="{{ old('first_name') }}" placeholder="Ismingiz" class="block w-full pl-10 pr-4 py-3 bg-slate-900/50 border border-white/10 rounded-xl text-sm text-white placeholder-slate-500 focus:ring-2 focus:ring-emerald-400 focus:border-emerald-400 outline-none transition-all duration-200 hover:border-slate-600 @error('first_name') border-rose-500/50 focus:ring-rose-500 @enderror" required />
                    </div>
                    @error('first_name') <p class="text-rose-400 text-xs mt-1.5">{{ $message }}</p> @enderror
                </div>

                {{-- Familiya --}}
                <div>
                    <label for="last_name" class="block text-sm font-semibold text-slate-200 mb-1.5">Familiya</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                        <input type="text" id="last_name" name="last_name" value="{{ old('last_name') }}" placeholder="Familiyangiz" class="block w-full pl-10 pr-4 py-3 bg-slate-900/50 border border-white/10 rounded-xl text-sm text-white placeholder-slate-500 focus:ring-2 focus:ring-emerald-400 focus:border-emerald-400 outline-none transition-all duration-200 hover:border-slate-600 @error('last_name') border-rose-500/50 focus:ring-rose-500 @enderror" required />
                    </div>
                    @error('last_name') <p class="text-rose-400 text-xs mt-1.5">{{ $message }}</p> @enderror
                </div>

                {{-- Email --}}
                <div>
                    <label for="email" class="block text-sm font-semibold text-slate-200 mb-1.5">Elektron pochta</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="email@manzil.uz" class="block w-full pl-10 pr-4 py-3 bg-slate-900/50 border border-white/10 rounded-xl text-sm text-white placeholder-slate-500 focus:ring-2 focus:ring-emerald-400 focus:border-emerald-400 outline-none transition-all duration-200 hover:border-slate-600 @error('email') border-rose-500/50 focus:ring-rose-500 @enderror" required />
                    </div>
                    @error('email') <p class="text-rose-400 text-xs mt-1.5">{{ $message }}</p> @enderror
                </div>

                {{-- Parol --}}
                <div>
                    <label for="password" class="block text-sm font-semibold text-slate-200 mb-1.5">Parol</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                            </svg>
                        </div>
                        <input :type="showPassword ? 'text' : 'password'" id="password" name="password" placeholder="Parol yarating" class="block w-full pl-10 pr-12 py-3 bg-slate-900/50 border border-white/10 rounded-xl text-sm text-white placeholder-slate-500 focus:ring-2 focus:ring-emerald-400 focus:border-emerald-400 outline-none transition-all duration-200 hover:border-slate-600 @error('password') border-rose-500/50 focus:ring-rose-500 @enderror" required />
                        <button type="button" @click="showPassword = !showPassword" class="absolute inset-y-0 right-0 pr-3 flex items-center text-slate-500 hover:text-slate-300 transition-colors">
                            {{-- Eye Icon --}}
                            <svg x-show="!showPassword" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                            {{-- Eye Off Icon --}}
                            <svg x-show="showPassword" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="display: none;">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                            </svg>
                        </button>
                    </div>
                    @error('password') <p class="text-rose-400 text-xs mt-1.5">{{ $message }}</p> @enderror
                </div>

                {{-- Parolni tasdiqlash --}}
                <div>
                    <label for="password_confirmation" class="block text-sm font-semibold text-slate-200 mb-1.5">Parolni tasdiqlash</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                            </svg>
                        </div>
                        <input :type="showConfirmation ? 'text' : 'password'" id="password_confirmation" name="password_confirmation" placeholder="Parolni qayta kiriting" class="block w-full pl-10 pr-12 py-3 bg-slate-900/50 border border-white/10 rounded-xl text-sm text-white placeholder-slate-500 focus:ring-2 focus:ring-emerald-400 focus:border-emerald-400 outline-none transition-all duration-200 hover:border-slate-600" required />
                        <button type="button" @click="showConfirmation = !showConfirmation" class="absolute inset-y-0 right-0 pr-3 flex items-center text-slate-500 hover:text-slate-300 transition-colors">
                            {{-- Eye Icon --}}
                            <svg x-show="!showConfirmation" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                            {{-- Eye Off Icon --}}
                            <svg x-show="showConfirmation" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="display: none;">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                            </svg>
                        </button>
                    </div>
                </div>

                {{-- Terms --}}
                <div class="flex items-start gap-3 py-3">
                    <input type="checkbox" id="terms" name="terms" class="mt-1 h-4 w-4 bg-slate-900 border-white/20 text-emerald-400 rounded focus:ring-emerald-400 focus:ring-offset-0 transition-colors" required />
                    <label for="terms" class="text-xs text-slate-300 leading-relaxed">
                        Men <a href="/terms" class="text-emerald-400 hover:text-emerald-300 underline underline-offset-2 transition-colors">foydalanish shartlari</a> va <a href="/privacy" class="text-emerald-400 hover:text-emerald-300 underline underline-offset-2 transition-colors">maxfiylik siyosati</a> bilan tanishib chiqdim va roziman
                    </label>
                </div>
                @error('terms') <p class="text-rose-400 text-xs -mt-2">{{ $message }}</p> @enderror

                <button type="submit" class="w-full flex justify-center items-center gap-2 px-6 py-4 bg-gradient-to-r from-emerald-400 to-blue-400 hover:from-emerald-300 hover:to-blue-300 text-slate-900 font-bold rounded-xl transition-all duration-300 active:scale-95 shadow-lg shadow-emerald-500/20 hover:shadow-xl hover:shadow-emerald-500/30">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                    </svg>
                    Ro'yxatdan o'tish
                </button>
            </form>

            <p class="mt-6 text-center text-sm text-slate-300">
                Hisobingiz bormi?
                <a href="{{ route('login') }}" class="font-bold text-blue-400 hover:text-blue-300 ml-1 transition-colors">
                    Kirish
                </a>
            </p>
        </div>
    </div>
</section>
@endsection