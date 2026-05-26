@extends('layouts.app')

@section('title', 'Professional Ta\'lim Tizimi')

@section('content')

@include('partials.header')

{{-- Hero Section --}}
<section class="relative bg-gradient-to-br from-slate-900 via-blue-900 to-slate-900 py-28 lg:py-36 overflow-hidden">
    {{-- Background Pattern --}}
    <div class="absolute inset-0 opacity-10">
        <div class="absolute top-0 left-0 w-full h-full" style="background-image: radial-gradient(circle at 25px 25px, white 2%, transparent 0%); background-size: 50px 50px;"></div>
    </div>
    {{-- Floating Blobs --}}
    <div class="absolute top-20 left-10 w-72 h-72 bg-blue-500/20 rounded-full blur-3xl animate-pulse"></div>
    <div class="absolute bottom-20 right-10 w-96 h-96 bg-emerald-500/20 rounded-full blur-3xl animate-pulse" style="animation-delay: 1s;"></div>
    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-64 h-64 bg-purple-500/10 rounded-full blur-3xl animate-pulse" style="animation-delay: 2s;"></div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        {{-- Badge --}}
        <span class="inline-flex items-center gap-2 bg-blue-500/20 text-blue-200 text-sm font-medium px-5 py-2 rounded-full mb-6 backdrop-blur-sm border border-blue-400/20">
            <svg class="w-4 h-4 text-blue-300" fill="currentColor" viewBox="0 0 20 20">
                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
            </svg>
            O'zbekistondagi eng ilg'or ta'lim platformasi
        </span>

        {{-- Title --}}
        <h1 class="text-4xl sm:text-5xl lg:text-7xl font-extrabold text-white tracking-tight leading-tight max-w-5xl mx-auto">
            Kelajakdagi <span class="bg-clip-text text-transparent bg-gradient-to-r from-blue-400 via-emerald-400 to-blue-400">bilimingiz</span> <br class="hidden sm:block"> shu yerdan boshlanadi
        </h1>

        {{-- Description --}}
        <p class="mt-8 text-lg sm:text-xl text-slate-300 max-w-3xl mx-auto leading-relaxed">
            O'qituvchilar va o'quvchilarni birlashtiruvchi, sifatli video darslar, amaliy topshiriqlar va real vaqtda o'zlashtirishni nazorat qilish imkoniyatiga ega professional ta'lim platformasi.
        </p>

        {{-- CTA Buttons --}}
        <div class="mt-12 flex flex-col sm:flex-row gap-5 justify-center items-center">
            <a href="/register" class="group w-full sm:w-auto px-10 py-4 text-base font-bold text-slate-900 bg-gradient-to-r from-emerald-400 to-blue-400 hover:from-emerald-300 hover:to-blue-300 rounded-xl shadow-lg shadow-blue-500/30 transition-all duration-300 hover:scale-105 active:scale-95">
                <span class="flex items-center justify-center gap-2">
                    Bepul boshlash
                    <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                    </svg>
                </span>
            </a>
            <a href="#about" class="w-full sm:w-auto px-10 py-4 text-base font-medium text-white border-2 border-white/20 hover:border-white/50 rounded-xl backdrop-blur-sm hover:bg-white/5 transition-all duration-300">
                <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                Platforma haqida
            </a>
        </div>
    </div>
</section>

{{-- Benefits Section --}}
<section id="benefits" class="py-24 bg-slate-900 relative overflow-hidden">
    {{-- Background Grid --}}
    <div class="absolute inset-0 opacity-5">
        <div class="absolute top-0 left-0 w-full h-full" style="background-image: radial-gradient(circle at 30px 30px, white 2px, transparent 0%); background-size: 60px 60px;"></div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
        <div class="text-center mb-20">
            <span class="text-blue-400 font-semibold text-sm tracking-wider uppercase bg-blue-500/10 px-4 py-1.5 rounded-full inline-block mb-4 border border-blue-500/20">
                Imkoniyatlar
            </span>
            <h2 class="text-4xl font-extrabold text-white">Ta'lim jarayonidagi qulayliklar</h2>
            <p class="mt-4 text-lg text-slate-400 max-w-2xl mx-auto">Zamonaviy o'qitish uslublari va texnologiyalari yordamida sifatli ta'lim olishingiz uchun barcha sharoitlar yaratilgan.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            {{-- Card 1 --}}
            <div class="group bg-slate-800/50 backdrop-blur-sm p-8 rounded-2xl shadow-lg hover:shadow-xl border border-white/5 hover:border-blue-500/30 transition-all duration-300 hover:-translate-y-2">
                <div class="w-14 h-14 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl flex items-center justify-center mb-6 text-white shadow-lg shadow-blue-500/20 group-hover:shadow-blue-500/30 transition-shadow">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-white mb-3">Sifatli Video Darslar</h3>
                <p class="text-slate-400 leading-relaxed">
                    O'qituvchilar tomonidan tayyorlangan yuqori sifatli va tushunarli video materiallar orqali mavzularni chuqur o'zlashtiring.
                </p>
            </div>

            {{-- Card 2 --}}
            <div class="group bg-slate-800/50 backdrop-blur-sm p-8 rounded-2xl shadow-lg hover:shadow-xl border border-white/5 hover:border-emerald-500/30 transition-all duration-300 hover:-translate-y-2">
                <div class="w-14 h-14 bg-gradient-to-br from-emerald-500 to-emerald-600 rounded-xl flex items-center justify-center mb-6 text-white shadow-lg shadow-emerald-500/20 group-hover:shadow-emerald-500/30 transition-shadow">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-white mb-3">Amaliy Topshiriqlar</h3>
                <p class="text-slate-400 leading-relaxed">
                    Nazariy bilimlarni mustahkamlash uchun maxsus ishlab chiqilgan amaliy mashqlar va uy vazifalarini bajaring.
                </p>
            </div>

            {{-- Card 3 --}}
            <div class="group bg-slate-800/50 backdrop-blur-sm p-8 rounded-2xl shadow-lg hover:shadow-xl border border-white/5 hover:border-purple-500/30 transition-all duration-300 hover:-translate-y-2">
                <div class="w-14 h-14 bg-gradient-to-br from-purple-500 to-purple-600 rounded-xl flex items-center justify-center mb-6 text-white shadow-lg shadow-purple-500/20 group-hover:shadow-purple-500/30 transition-shadow">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-white mb-3">Avtomatlashtirilgan Testlar</h3>
                <p class="text-slate-400 leading-relaxed">
                    O'tilgan mavzular bo'yicha bilimlaringizni testlar orqali sinab ko'ring va natijalarni darhol bilib oling.
                </p>
            </div>

            {{-- Card 4 --}}
            <div class="group bg-slate-800/50 backdrop-blur-sm p-8 rounded-2xl shadow-lg hover:shadow-xl border border-white/5 hover:border-amber-500/30 transition-all duration-300 hover:-translate-y-2">
                <div class="w-14 h-14 bg-gradient-to-br from-amber-500 to-amber-600 rounded-xl flex items-center justify-center mb-6 text-white shadow-lg shadow-amber-500/20 group-hover:shadow-amber-500/30 transition-shadow">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-white mb-3">O'zlashtirish Nazorati</h3>
                <p class="text-slate-400 leading-relaxed">
                    O'zlashtirish ko'rsatkichlari, olingan baholar va taraqqiyotingizni shaxsiy kabinetingiz orqali kuzatib boring.
                </p>
            </div>
        </div>
    </div>
</section>

{{-- How it Works Section --}}
<section id="about" class="py-24 bg-slate-800/50 relative overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-20">
            <span class="text-emerald-400 font-semibold text-sm tracking-wider uppercase bg-emerald-500/10 px-4 py-1.5 rounded-full inline-block mb-4 border border-emerald-500/20">
                Jarayon
            </span>
            <h2 class="text-4xl font-extrabold text-white">O'qish jarayoni qanday ishlaydi?</h2>
            <p class="mt-4 text-lg text-slate-400">Ta'limni boshlash uchun uchta oddiy qadam</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 lg:gap-16 text-center">
            {{-- Step 1 --}}
            <div class="group">
                <div class="relative inline-flex mb-8">
                    <div class="w-20 h-20 bg-gradient-to-br from-blue-500 to-blue-600 text-white rounded-2xl flex items-center justify-center text-3xl font-extrabold shadow-xl shadow-blue-500/20 group-hover:shadow-blue-500/30 transition-all duration-300 group-hover:scale-110">1</div>
                    <span class="absolute -top-3 -right-3 w-8 h-8 bg-emerald-500 rounded-full border-4 border-slate-800 flex items-center justify-center shadow-lg">
                        <svg class="w-3 h-3 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                        </svg>
                    </span>
                </div>
                <h3 class="text-2xl font-bold text-white mb-4">Ro'yxatdan o'tish</h3>
                <p class="text-slate-400 leading-relaxed max-w-xs mx-auto">Platformada shaxsiy hisob yarating va kerakli ma'lumotlarni to'ldiring.</p>
            </div>

            {{-- Step 2 --}}
            <div class="group">
                <div class="relative inline-flex mb-8">
                    <div class="w-20 h-20 bg-gradient-to-br from-emerald-500 to-emerald-600 text-white rounded-2xl flex items-center justify-center text-3xl font-extrabold shadow-xl shadow-emerald-500/20 group-hover:shadow-emerald-500/30 transition-all duration-300 group-hover:scale-110">2</div>
                </div>
                <h3 class="text-2xl font-bold text-white mb-4">Kursga qo'shilish</h3>
                <p class="text-slate-400 leading-relaxed max-w-xs mx-auto">O'zingizga kerakli bo'lgan ta'lim yo'nalishini tanlang va guruhga qo'shiling.</p>
            </div>

            {{-- Step 3 --}}
            <div class="group">
                <div class="relative inline-flex mb-8">
                    <div class="w-20 h-20 bg-gradient-to-br from-purple-500 to-purple-600 text-white rounded-2xl flex items-center justify-center text-3xl font-extrabold shadow-xl shadow-purple-500/20 group-hover:shadow-purple-500/30 transition-all duration-300 group-hover:scale-110">3</div>
                </div>
                <h3 class="text-2xl font-bold text-white mb-4">O'rganish va topshiriq</h3>
                <p class="text-slate-400 leading-relaxed max-w-xs mx-auto">Darslarni muntazam kuzatib boring, topshiriqlarni bajaring va ustozdan fikr-mulohaza oling.</p>
            </div>
        </div>
    </div>
</section>

{{-- For Users Section --}}
<section class="py-24 bg-slate-900 relative">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-20">
            <span class="text-purple-400 font-semibold text-sm tracking-wider uppercase bg-purple-500/10 px-4 py-1.5 rounded-full inline-block mb-4 border border-purple-500/20">
                Kimlar uchun
            </span>
            <h2 class="text-4xl font-extrabold text-white">Har bir foydalanuvchi uchun</h2>
            <p class="mt-4 text-lg text-slate-400 max-w-2xl mx-auto">Platformamiz o'qituvchilar va o'quvchilar uchun teng imkoniyatlar yaratadi</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-24">
            {{-- Teachers Card --}}
            <div class="group bg-slate-800/50 backdrop-blur-sm p-10 rounded-3xl shadow-xl border border-white/5 hover:border-blue-500/30 transition-all duration-300 hover:shadow-2xl hover:-translate-y-1">
                <div class="flex items-center gap-4 mb-8">
                    <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl flex items-center justify-center shadow-lg shadow-blue-500/20 group-hover:shadow-blue-500/30 transition-shadow">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-2xl font-extrabold text-white">O'qituvchilar uchun</h3>
                        <p class="text-slate-400 text-sm">Professional boshqaruv paneli</p>
                    </div>
                </div>
                <ul class="space-y-5">
                    <li class="flex items-start gap-3 group/item">
                        <span class="flex-shrink-0 w-6 h-6 bg-blue-500/10 rounded-lg flex items-center justify-center text-blue-400 group-hover/item:bg-blue-500/20 transition-colors">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                            </svg>
                        </span>
                        <span class="text-slate-300 font-medium">Guruhlar va dars jadvallarini boshqarish</span>
                    </li>
                    <li class="flex items-start gap-3 group/item">
                        <span class="flex-shrink-0 w-6 h-6 bg-blue-500/10 rounded-lg flex items-center justify-center text-blue-400 group-hover/item:bg-blue-500/20 transition-colors">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                            </svg>
                        </span>
                        <span class="text-slate-300 font-medium">Uy vazifalari va testlarni yaratish tizimi</span>
                    </li>
                    <li class="flex items-start gap-3 group/item">
                        <span class="flex-shrink-0 w-6 h-6 bg-blue-500/10 rounded-lg flex items-center justify-center text-blue-400 group-hover/item:bg-blue-500/20 transition-colors">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                            </svg>
                        </span>
                        <span class="text-slate-300 font-medium">Har bir o'quvchining shaxsiy natijalarini kuzatish</span>
                    </li>
                </ul>
            </div>

            {{-- Students Card --}}
            <div class="group bg-slate-800/50 backdrop-blur-sm p-10 rounded-3xl shadow-xl border border-white/5 hover:border-emerald-500/30 transition-all duration-300 hover:shadow-2xl hover:-translate-y-1">
                <div class="flex items-center gap-4 mb-8">
                    <div class="w-16 h-16 bg-gradient-to-br from-emerald-500 to-emerald-600 rounded-2xl flex items-center justify-center shadow-lg shadow-emerald-500/20 group-hover:shadow-emerald-500/30 transition-shadow">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-2xl font-extrabold text-white">O'quvchilar uchun</h3>
                        <p class="text-slate-400 text-sm">Qulay o'quv muhiti</p>
                    </div>
                </div>
                <ul class="space-y-5">
                    <li class="flex items-start gap-3 group/item">
                        <span class="flex-shrink-0 w-6 h-6 bg-emerald-500/10 rounded-lg flex items-center justify-center text-emerald-400 group-hover/item:bg-emerald-500/20 transition-colors">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                            </svg>
                        </span>
                        <span class="text-slate-300 font-medium">Tizimlashtirilgan o'quv materiallariga doimiy kirish</span>
                    </li>
                    <li class="flex items-start gap-3 group/item">
                        <span class="flex-shrink-0 w-6 h-6 bg-emerald-500/10 rounded-lg flex items-center justify-center text-emerald-400 group-hover/item:bg-emerald-500/20 transition-colors">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                            </svg>
                        </span>
                        <span class="text-slate-300 font-medium">O'z vaqtida topshiriqlarni yuklash va tekshirish</span>
                    </li>
                    <li class="flex items-start gap-3 group/item">
                        <span class="flex-shrink-0 w-6 h-6 bg-emerald-500/10 rounded-lg flex items-center justify-center text-emerald-400 group-hover/item:bg-emerald-500/20 transition-colors">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                            </svg>
                        </span>
                        <span class="text-slate-300 font-medium">Darajalar va reyting tizimi orqali motivatsiya</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>

{{-- Stats Section --}}
<section class="py-20 bg-gradient-to-r from-slate-900 via-blue-900 to-slate-900 relative overflow-hidden">
    <div class="absolute inset-0 opacity-10">
        <div class="absolute top-0 left-0 w-full h-full" style="background-image: radial-gradient(circle at 40px 40px, white 2px, transparent 0%); background-size: 80px 80px;"></div>
    </div>
    <div class="absolute top-0 left-1/4 w-64 h-64 bg-blue-500/20 rounded-full blur-3xl"></div>
    <div class="absolute bottom-0 right-1/4 w-64 h-64 bg-emerald-500/20 rounded-full blur-3xl"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
            <div class="flex flex-col group p-6 rounded-2xl hover:bg-white/5 transition-colors">
                <span class="text-5xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-emerald-400 mb-3">15k+</span>
                <span class="text-blue-200/80 font-medium text-sm tracking-wide">O'quvchilar</span>
            </div>
            <div class="flex flex-col group p-6 rounded-2xl hover:bg-white/5 transition-colors">
                <span class="text-5xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-emerald-400 mb-3">300+</span>
                <span class="text-blue-200/80 font-medium text-sm tracking-wide">O'qituvchilar</span>
            </div>
            <div class="flex flex-col group p-6 rounded-2xl hover:bg-white/5 transition-colors">
                <span class="text-5xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-emerald-400 mb-3">45k+</span>
                <span class="text-blue-200/80 font-medium text-sm tracking-wide">Topshiriqlar</span>
            </div>
            <div class="flex flex-col group p-6 rounded-2xl hover:bg-white/5 transition-colors">
                <span class="text-5xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-emerald-400 mb-3">10k+</span>
                <span class="text-blue-200/80 font-medium text-sm tracking-wide">Darslar</span>
            </div>
        </div>
    </div>
</section>

{{-- CTA Section --}}
<section class="py-20 bg-slate-900 relative">
    <div class="absolute inset-0 opacity-5">
        <div class="absolute top-0 left-0 w-full h-full" style="background-image: radial-gradient(circle at 25px 25px, white 2%, transparent 0%); background-size: 50px 50px;"></div>
    </div>

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative">
        <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-emerald-500 rounded-2xl flex items-center justify-center mx-auto mb-8 shadow-lg shadow-blue-500/20">
            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
            </svg>
        </div>
        <h2 class="text-3xl lg:text-4xl font-extrabold text-white mb-6">
            Ta'lim olishni <span class="bg-clip-text text-transparent bg-gradient-to-r from-blue-400 to-emerald-400">hoziroq</span> boshlang
        </h2>
        <p class="text-lg text-slate-400 mb-10 max-w-2xl mx-auto">
            Minglab o'quvchilar va o'qituvchilar qatoriga qo'shiling. O'z bilimingizni oshiring yoki boshqalarga bilim bering.
        </p>
        <div class="flex flex-col sm:flex-row gap-5 justify-center">
            <a href="/register" class="group w-full sm:w-auto px-10 py-4 text-base font-bold text-white bg-gradient-to-r from-blue-600 to-emerald-600 hover:from-blue-500 hover:to-emerald-500 rounded-xl shadow-xl shadow-blue-500/20 hover:shadow-blue-500/30 transition-all duration-300 hover:scale-105 active:scale-95">
                <span class="flex items-center justify-center gap-2">
                    Ro'yxatdan o'tish
                    <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                    </svg>
                </span>
            </a>
            <a href="/login" class="w-full sm:w-auto px-10 py-4 text-base font-medium text-slate-300 border-2 border-white/10 hover:border-white/30 rounded-xl hover:bg-white/5 transition-all duration-300">
                Tizimga kirish
            </a>
        </div>
    </div>
</section>

@include('partials.footer')

@endsection