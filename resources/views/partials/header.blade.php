<header x-data="{ mobileMenuOpen: false }" class="bg-slate-900/80 backdrop-blur-md sticky top-0 z-50 border-b border-white/5 shadow-sm transition-all duration-300">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-20">

            {{-- Logo --}}
            <div class="flex-shrink-0 flex items-center">
                <a href="/" class="flex items-center gap-3 group">
                    <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl flex items-center justify-center shadow-lg shadow-blue-500/20 group-hover:shadow-blue-500/30 transition-all duration-300 group-hover:scale-105">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0v6m0-6l-9 5m9-5l9 5"></path>
                        </svg>
                    </div>
                    <span class="font-extrabold text-2xl tracking-tight text-white">Edu<span class="text-blue-500">Nova</span></span>
                </a>
            </div>

            {{-- Desktop Navigation --}}
            <nav class="hidden md:flex space-x-1">
                <a href="/" class="px-4 py-2 text-blue-400 font-semibold bg-blue-500/10 rounded-lg transition-colors duration-200">Bosh sahifa</a>
                <a href="#about" class="px-4 py-2 text-slate-400 hover:text-white hover:bg-slate-800/50 rounded-lg font-medium transition-all duration-200">Platforma haqida</a>
                <a href="#benefits" class="px-4 py-2 text-slate-400 hover:text-white hover:bg-slate-800/50 rounded-lg font-medium transition-all duration-200">Afzalliklar</a>
                <a href="#contact" class="px-4 py-2 text-slate-400 hover:text-white hover:bg-slate-800/50 rounded-lg font-medium transition-all duration-200">Bog'lanish</a>
            </nav>

            {{-- Desktop Auth Buttons --}}
            <div class="hidden md:flex items-center space-x-4">
                <a href="/login" class="px-5 py-2.5 text-slate-300 hover:text-white font-medium hover:bg-slate-800 rounded-lg transition-all duration-200">
                    Kirish
                </a>
                <a href="/register" class="px-6 py-2.5 bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-500 hover:to-blue-600 text-white font-medium rounded-lg shadow-md shadow-blue-500/20 hover:shadow-lg hover:shadow-blue-500/30 transition-all duration-300 hover:scale-105 active:scale-95">
                    Ro'yxatdan o'tish
                </a>
            </div>

            {{-- Mobile Menu Button --}}
            <div class="flex items-center md:hidden">
                <button @click="mobileMenuOpen = !mobileMenuOpen" class="text-slate-400 hover:text-white focus:outline-none p-2 rounded-lg hover:bg-slate-800 transition-colors">
                    <svg x-show="!mobileMenuOpen" class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                    <svg x-show="mobileMenuOpen" class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24" style="display: none;">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    {{-- Mobile Menu --}}
    <div x-show="mobileMenuOpen" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 -translate-y-2" x-transition:enter-end="opacity-100 translate-y-0" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 -translate-y-2" class="md:hidden bg-slate-900/95 backdrop-blur-md border-t border-white/5 absolute w-full shadow-xl" style="display: none;">
        <div class="px-4 pt-2 pb-6 space-y-2">
            <a href="/" class="block px-4 py-3.5 rounded-xl text-base font-semibold text-blue-400 bg-blue-500/10">Bosh sahifa</a>
            <a href="#about" @click="mobileMenuOpen = false" class="block px-4 py-3.5 rounded-xl text-base font-medium text-slate-400 hover:text-white hover:bg-slate-800/50 transition-colors">Platforma haqida</a>
            <a href="#benefits" @click="mobileMenuOpen = false" class="block px-4 py-3.5 rounded-xl text-base font-medium text-slate-400 hover:text-white hover:bg-slate-800/50 transition-colors">Afzalliklar</a>
            <a href="#contact" @click="mobileMenuOpen = false" class="block px-4 py-3.5 rounded-xl text-base font-medium text-slate-400 hover:text-white hover:bg-slate-800/50 transition-colors">Bog'lanish</a>

            <div class="mt-4 pt-4 border-t border-white/5 flex flex-col gap-3">
                <a href="/login" class="block text-center px-5 py-3.5 rounded-xl text-base font-medium text-slate-300 border border-white/10 hover:border-white/20 hover:bg-slate-800/50 transition-all">
                    Kirish
                </a>
                <a href="/register" class="block text-center px-5 py-3.5 rounded-xl text-base font-medium text-white bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-500 hover:to-blue-600 shadow-md transition-all">
                    Ro'yxatdan o'tish
                </a>
            </div>
        </div>
    </div>
</header>