<header class="bg-white/80 backdrop-blur-md sticky top-0 z-50 border-b border-slate-200/60 shadow-sm transition-all duration-300">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-20">

            {{-- Logo --}}
            <div class="flex-shrink-0 flex items-center">
                <a href="/" class="flex items-center gap-3 group">
                    <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl flex items-center justify-center shadow-lg shadow-blue-200 group-hover:shadow-blue-300 transition-all duration-300 group-hover:scale-105">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0v6m0-6l-9 5m9-5l9 5"></path>
                        </svg>
                    </div>
                    <span class="font-extrabold text-2xl tracking-tight text-slate-900">Edu<span class="text-blue-600">Nova</span></span>
                </a>
            </div>

            {{-- Desktop Navigation --}}
            <nav class="hidden md:flex space-x-1">
                <a href="/" class="px-4 py-2 text-blue-600 font-semibold bg-blue-50 rounded-lg transition-colors duration-200">Bosh sahifa</a>
                <a href="#about" class="px-4 py-2 text-slate-600 hover:text-blue-600 hover:bg-slate-50 rounded-lg font-medium transition-all duration-200">Platforma haqida</a>
                <a href="#benefits" class="px-4 py-2 text-slate-600 hover:text-blue-600 hover:bg-slate-50 rounded-lg font-medium transition-all duration-200">Afzalliklar</a>
                <a href="#contact" class="px-4 py-2 text-slate-600 hover:text-blue-600 hover:bg-slate-50 rounded-lg font-medium transition-all duration-200">Bog'lanish</a>
            </nav>

            {{-- Desktop Auth Buttons --}}
            <div class="hidden md:flex items-center space-x-4">

                {{-- Show login and register buttons only if the user is a guest (not logged in) --}}
                @guest
                <a href="{{ route('login') }}" class="px-5 py-2.5 text-slate-700 hover:text-slate-900 font-medium hover:bg-slate-100 rounded-lg transition-all duration-200">
                    Kirish
                </a>
                <a href="{{ route('register') }}" class="px-6 py-2.5 bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-500 hover:to-blue-600 text-white font-medium rounded-lg shadow-md shadow-blue-200 hover:shadow-lg hover:shadow-blue-300 transition-all duration-300 hover:scale-105 active:scale-95">
                    Ro'yxatdan o'tish
                </a>
                @endguest

                {{-- Show Dashboard and Logout buttons if the user is authenticated --}}
                @auth
                <div class="flex items-center gap-3">
                    {{-- Dashboard Link --}}
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-2 px-4 py-2 bg-blue-50 hover:bg-blue-100 rounded-lg border border-blue-200 transition-colors duration-200">
                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                        </svg>
                        <span class="font-bold text-sm text-blue-700">Shaxsiy kabinet</span>
                    </a>

                    {{-- Secure logout form --}}
                    <form method="POST" action="{{ route('logout') }}" class="m-0">
                        @csrf
                        <button type="submit" class="px-4 py-2 text-sm text-red-600 font-medium hover:bg-red-50 rounded-lg transition-all duration-200 flex items-center gap-1">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                            </svg>
                            Chiqish
                        </button>
                    </form>
                </div>
                @endauth

            </div>

            {{-- Mobile Menu Button --}}
            <div class="flex items-center md:hidden">
                <button type="button" id="mobileMenuButton" class="text-slate-500 hover:text-slate-900 focus:outline-none p-2 rounded-lg hover:bg-slate-100 transition-colors">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    {{-- Mobile Menu --}}
    <div id="mobileMenu" class="hidden md:hidden bg-white/95 backdrop-blur-md border-t border-slate-100 absolute w-full shadow-xl">
        <div class="px-4 pt-2 pb-6 space-y-2">
            <a href="/" class="block px-4 py-3.5 rounded-xl text-base font-semibold text-blue-600 bg-blue-50">Bosh sahifa</a>
            <a href="#about" class="block px-4 py-3.5 rounded-xl text-base font-medium text-slate-700 hover:text-blue-600 hover:bg-slate-50 transition-colors">Platforma haqida</a>
            <a href="#benefits" class="block px-4 py-3.5 rounded-xl text-base font-medium text-slate-700 hover:text-blue-600 hover:bg-slate-50 transition-colors">Afzalliklar</a>
            <a href="#contact" class="block px-4 py-3.5 rounded-xl text-base font-medium text-slate-700 hover:text-blue-600 hover:bg-slate-50 transition-colors">Bog'lanish</a>

            <div class="mt-4 pt-4 border-t border-slate-200 flex flex-col gap-3">

                {{-- Mobile: Guest Auth Links --}}
                @guest
                <a href="{{ route('login') }}" class="block text-center px-5 py-3.5 rounded-xl text-base font-medium text-slate-700 border-2 border-slate-200 hover:border-slate-300 hover:bg-slate-50 transition-all">
                    Kirish
                </a>
                <a href="{{ route('register') }}" class="block text-center px-5 py-3.5 rounded-xl text-base font-medium text-white bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-500 hover:to-blue-600 shadow-md transition-all">
                    Ro'yxatdan o'tish
                </a>
                @endguest

                {{-- Mobile: Authenticated User Info & Logout --}}
                @auth
                {{-- Dashboard Link --}}
                <a href="{{ route('dashboard') }}" class="flex items-center justify-center gap-2 px-5 py-3.5 bg-blue-50 hover:bg-blue-100 rounded-xl border border-blue-200 transition-colors">
                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                    </svg>
                    <span class="font-bold text-blue-700">Shaxsiy kabinet</span>
                </a>

                <form method="POST" action="{{ route('logout') }}" class="m-0">
                    @csrf
                    <button type="submit" class="w-full flex items-center justify-center gap-2 text-center px-5 py-3.5 rounded-xl text-base font-medium text-red-600 border-2 border-red-100 hover:border-red-200 hover:bg-red-50 transition-all">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                        </svg>
                        Tizimdan chiqish
                    </button>
                </form>
                @endauth

            </div>
        </div>
    </div>
</header>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const mobileMenuButton = document.getElementById('mobileMenuButton');
        const mobileMenu = document.getElementById('mobileMenu');

        // Toggle mobile menu visibility
        mobileMenuButton.addEventListener('click', function() {
            mobileMenu.classList.toggle('hidden');
        });

        // Close mobile menu when clicking a link
        const mobileLinks = mobileMenu.querySelectorAll('a');
        mobileLinks.forEach(link => {
            link.addEventListener('click', function() {
                mobileMenu.classList.add('hidden');
            });
        });
    });
</script>