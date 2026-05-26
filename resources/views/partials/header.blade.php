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
                <a href="/login" class="px-5 py-2.5 text-slate-700 hover:text-slate-900 font-medium hover:bg-slate-100 rounded-lg transition-all duration-200">
                    Kirish
                </a>
                <a href="/register" class="px-6 py-2.5 bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-500 hover:to-blue-600 text-white font-medium rounded-lg shadow-md shadow-blue-200 hover:shadow-lg hover:shadow-blue-300 transition-all duration-300 hover:scale-105 active:scale-95">
                    Ro'yxatdan o'tish
                </a>
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
                <a href="/login" class="block text-center px-5 py-3.5 rounded-xl text-base font-medium text-slate-700 border-2 border-slate-200 hover:border-slate-300 hover:bg-slate-50 transition-all">
                    Kirish
                </a>
                <a href="/register" class="block text-center px-5 py-3.5 rounded-xl text-base font-medium text-white bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-500 hover:to-blue-600 shadow-md transition-all">
                    Ro'yxatdan o'tish
                </a>
            </div>
        </div>
    </div>
</header>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const mobileMenuButton = document.getElementById('mobileMenuButton');
        const mobileMenu = document.getElementById('mobileMenu');

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