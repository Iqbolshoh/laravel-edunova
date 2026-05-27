<footer id="contact" class="bg-slate-900 border-t border-white/5 mt-auto">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-12">

            {{-- Brand Column --}}
            <div class="col-span-1 md:col-span-2">
                <a href="/" class="flex items-center gap-3 mb-6 group">
                    <div class="w-10 h-10 flex items-center justify-center transition-all duration-300 group-hover:scale-105 drop-shadow-lg shadow-blue-500/20">
                        <img src="{{ asset('logo.png') }}" alt="CloudNova Logo" class="w-full h-full object-contain">
                    </div>
                    <span class="font-extrabold text-xl tracking-tight text-white">Cloud<span class="text-blue-500">Nova</span></span>
                </a>
                <p class="text-slate-400 text-sm leading-relaxed max-w-sm">
                    CloudNova — ta'lim jarayonini zamonaviy, interaktiv va samarali tashkil etish uchun yaratilgan professional ta'lim platformasi. O'qituvchilar va o'quvchilarni bir joyda jamlaymiz.
                </p>
            </div>

            {{-- Quick Links --}}
            <div>
                <h3 class="text-sm font-bold text-white tracking-wider uppercase mb-6">Tezkor havolalar</h3>
                <ul class="space-y-4">
                    <li>
                        <a href="#about" class="text-sm text-slate-400 hover:text-blue-400 transition-colors flex items-center gap-2 group">
                            <svg class="w-4 h-4 text-slate-600 group-hover:text-blue-400 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                            Platforma haqida
                        </a>
                    </li>
                    <li>
                        <a href="#benefits" class="text-sm text-slate-400 hover:text-blue-400 transition-colors flex items-center gap-2 group">
                            <svg class="w-4 h-4 text-slate-600 group-hover:text-blue-400 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                            Imkoniyatlar
                        </a>
                    </li>
                    <li>
                        <a href="/login" class="text-sm text-slate-400 hover:text-blue-400 transition-colors flex items-center gap-2 group">
                            <svg class="w-4 h-4 text-slate-600 group-hover:text-blue-400 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                            Tizimga kirish
                        </a>
                    </li>
                    <li>
                        <a href="/register" class="text-sm text-slate-400 hover:text-blue-400 transition-colors flex items-center gap-2 group">
                            <svg class="w-4 h-4 text-slate-600 group-hover:text-blue-400 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                            Ro'yxatdan o'tish
                        </a>
                    </li>
                </ul>
            </div>

            {{-- Contact Column --}}
            <div>
                <h3 class="text-sm font-bold text-white tracking-wider uppercase mb-6">Bog'lanish</h3>
                <ul class="space-y-4 mb-8">
                    <li class="flex items-center gap-3 text-sm text-slate-400">
                        <svg class="w-5 h-5 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                        info@cloudnova.uz
                    </li>
                    <li class="flex items-center gap-3 text-sm text-slate-400">
                        <svg class="w-5 h-5 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                        </svg>
                        +998 90 123 45 67
                    </li>
                </ul>
                <div class="flex space-x-3">
                    <a href="#" class="w-10 h-10 bg-slate-800 hover:bg-blue-500/10 rounded-lg flex items-center justify-center text-slate-400 hover:text-blue-400 transition-all duration-200 hover:shadow-md border border-white/5">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path fill-rule="evenodd" d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" clip-rule="evenodd" />
                        </svg>
                    </a>
                    <a href="#" class="w-10 h-10 bg-slate-800 hover:bg-blue-500/10 rounded-lg flex items-center justify-center text-slate-400 hover:text-blue-400 transition-all duration-200 hover:shadow-md border border-white/5">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M11.944 0A12 12 0 0 0 0 12a12 12 0 0 0 12 12 12 12 0 0 0 12-12A12 12 0 0 0 12 0a5.66 5.66 0 0 0-.474.017C10.748.118 9.043.606 7.498 1.41L17.74 5.38c.633.246.541 1.15-.125 1.28L6.47 8.94c-.655.13-1.12.7-1.144 1.373-.024.674.407 1.272 1.053 1.464l3.197.946 1.764 5.42a1.32 1.32 0 0 0 2.217.514l2.45-2.616 3.642 2.667c.563.413 1.36.143 1.517-.518L23.94 2.82c.16-.675-.417-1.258-1.077-1.066L11.944 0z" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>

        {{-- Footer Bottom --}}
        <div class="mt-12 pt-8 border-t border-white/5 flex flex-col md:flex-row justify-between items-center gap-4">
            <p class="text-slate-500 text-sm">
                &copy; {{ date('Y') }} CloudNova Platformasi. Barcha huquqlar himoyalangan.
            </p>
            <div class="flex space-x-6 text-sm text-slate-500">
                <a href="/privacy" class="hover:text-slate-300 transition-colors">Maxfiylik siyosati</a>
                <a href="/terms" class="hover:text-slate-300 transition-colors">Foydalanish shartlari</a>
            </div>
        </div>
    </div>
</footer>