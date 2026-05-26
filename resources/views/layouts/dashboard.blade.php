<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title', 'Dashboard') - EduNova</title>

    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body class="bg-slate-900 text-slate-200 font-sans antialiased selection:bg-blue-500 selection:text-white overflow-hidden">

    <div x-data="{ mobileMenuOpen: false, logoutModalOpen: false }" class="flex h-screen w-full relative">

        <div x-show="logoutModalOpen" class="fixed inset-0 z-[60] overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true" style="display: none;">
            <div x-show="logoutModalOpen" x-transition.opacity class="fixed inset-0 bg-slate-900/80 backdrop-blur-sm"></div>

            <div class="flex min-h-screen items-center justify-center p-4 text-center sm:p-0 z-10 relative">
                <div x-show="logoutModalOpen" @click.away="logoutModalOpen = false" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" class="relative transform overflow-hidden rounded-2xl bg-slate-800/90 border border-white/10 text-left shadow-2xl shadow-rose-500/10 transition-all sm:my-8 sm:w-full sm:max-w-md p-6">
                    <div>
                        <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-full bg-rose-500/20 border border-rose-500/30">
                            <svg class="h-8 w-8 text-rose-500" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15m3 0l3-3m0 0l-3-3m3 3H9" />
                            </svg>
                        </div>
                        <div class="mt-5 text-center sm:mt-6">
                            <h3 class="text-xl font-semibold leading-6 text-white" id="modal-title">Tizimdan chiqish</h3>
                            <div class="mt-2">
                                <p class="text-sm text-slate-400">Haqiqatan ham hisobingizdan chiqmoqchimisiz? Davom etsangiz, tizimga qayta kirishingiz kerak bo'ladi.</p>
                            </div>
                        </div>
                    </div>

                    <div class="mt-6 flex flex-col sm:flex-row-reverse gap-3 sm:gap-4">
                        <form action="{{ route('logout') }}" method="POST" class="w-full sm:w-auto flex-1">
                            @csrf
                            <button type="submit" class="w-full justify-center rounded-xl bg-rose-500 px-4 py-2.5 text-sm font-semibold text-white shadow-lg shadow-rose-500/30 hover:bg-rose-400 focus:outline-none focus:ring-2 focus:ring-rose-500 transition-colors">
                                Ha, chiqish
                            </button>
                        </form>
                        <button type="button" @click="logoutModalOpen = false" class="mt-3 sm:mt-0 w-full sm:w-auto flex-1 justify-center rounded-xl bg-slate-700/50 px-4 py-2.5 text-sm font-semibold text-white shadow-sm ring-1 ring-inset ring-slate-600 hover:bg-slate-700 focus:outline-none transition-colors">
                            Yo'q, qolish
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div x-show="mobileMenuOpen"
            @click="mobileMenuOpen = false"
            x-transition.opacity
            class="fixed inset-0 bg-slate-900/80 backdrop-blur-sm z-40 md:hidden"
            style="display: none;"></div>

        <aside class="w-64 bg-slate-900/95 backdrop-blur-xl border-r border-white/5 flex flex-col transition-transform duration-300 z-50 fixed inset-y-0 left-0 md:relative md:translate-x-0"
            :class="mobileMenuOpen ? 'translate-x-0' : '-translate-x-full'">

            <div class="h-20 flex items-center px-6 border-b border-white/5">
                <a href="{{ route('dashboard') }}" class="flex items-center group">
                    <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-blue-500 to-blue-600 flex items-center justify-center mr-3 shadow-lg shadow-blue-500/20">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0v6m0-6l-9 5m9-5l9 5"></path>
                        </svg>
                    </div>
                    <span class="font-bold text-xl tracking-tight text-white">Edu<span class="text-blue-500">Nova</span></span>
                </a>

                <button @click="mobileMenuOpen = false" class="md:hidden ml-auto text-slate-400 hover:text-white p-2 rounded-lg hover:bg-slate-800 transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <nav class="flex-1 px-4 py-6 space-y-2 overflow-y-auto">
                <a href="{{ route('dashboard') }}" class="flex items-center px-4 py-3 rounded-xl transition-all duration-200 {{ request()->routeIs('dashboard') ? 'bg-blue-500/10 text-blue-400 font-medium' : 'text-slate-400 hover:bg-slate-800/50 hover:text-white' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>
                    </svg>
                    Umumiy panel
                </a>

                <a href="#" class="flex items-center px-4 py-3 rounded-xl transition-all duration-200 text-slate-400 hover:bg-slate-800/50 hover:text-white">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                    </svg>
                    Mening kurslarim
                </a>

                <a href="#" class="flex items-center px-4 py-3 rounded-xl transition-all duration-200 text-slate-400 hover:bg-slate-800/50 hover:text-white">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                    </svg>
                    Vazifalar
                </a>
            </nav>

            <div class="p-4 border-t border-white/5">
                <button @click="logoutModalOpen = true" type="button" class="w-full flex items-center px-4 py-3 text-slate-400 hover:text-rose-400 hover:bg-rose-500/10 rounded-xl transition-all duration-200">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                    </svg>
                    Tizimdan chiqish
                </button>
            </div>
        </aside>

        <div class="flex-1 flex flex-col h-screen overflow-hidden bg-slate-900/50 relative">

            <div class="absolute inset-0 w-full h-full z-0 overflow-hidden pointer-events-none">
                <div class="absolute top-[-10%] left-[-10%] w-96 h-96 bg-blue-500/10 rounded-full mix-blend-screen filter blur-3xl opacity-50 animate-blob"></div>
                <div class="absolute bottom-[-10%] right-[-10%] w-96 h-96 bg-indigo-500/10 rounded-full mix-blend-screen filter blur-3xl opacity-50 animate-blob" style="animation-delay: 2s;"></div>
            </div>

            <header class="h-20 flex items-center justify-between px-6 bg-slate-900/80 backdrop-blur-md border-b border-white/5 z-30 relative">

                <button @click="mobileMenuOpen = true" class="md:hidden text-slate-400 hover:text-white p-2 rounded-lg hover:bg-slate-800 transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>

                <h1 class="hidden md:block text-xl font-semibold text-white">@yield('header_title', 'Dashboard')</h1>

                <div class="flex items-center space-x-4">
                    <a href="#" class="hidden sm:flex bg-blue-500/10 hover:bg-blue-500/20 text-blue-400 border border-blue-500/20 px-4 py-2 rounded-lg text-sm font-medium transition-colors items-center">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                        Kurslar katalogi
                    </a>

                    <button class="relative p-2 text-slate-400 hover:text-white transition-colors hover:bg-slate-800 rounded-lg">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                        </svg>
                        <span class="absolute top-1.5 right-1.5 block w-2.5 h-2.5 bg-rose-500 rounded-full border-2 border-slate-900"></span>
                    </button>

                    <div x-data="{ dropdownOpen: false }" class="relative">
                        <button @click="dropdownOpen = !dropdownOpen" @click.away="dropdownOpen = false" class="flex items-center focus:outline-none p-1 rounded-full hover:bg-slate-800 transition-colors">
                            <div class="w-9 h-9 rounded-full bg-slate-800 border border-slate-700 flex items-center justify-center overflow-hidden">
                                <span class="text-sm font-medium text-slate-300">{{ substr(auth()->user()->name ?? 'U', 0, 1) }}</span>
                            </div>
                            <svg class="w-4 h-4 ml-2 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>

                        <div x-show="dropdownOpen" x-transition:enter="transition ease-out duration-100" x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="transform opacity-100 scale-100" x-transition:leave-end="transform opacity-0 scale-95" class="absolute right-0 mt-2 w-48 bg-slate-800 border border-slate-700 rounded-xl shadow-lg py-1 z-50" style="display: none;">
                            <div class="px-4 py-3 border-b border-slate-700/50 text-sm">
                                <p class="text-white font-medium truncate">{{ auth()->user()->name ?? 'User' }}</p>
                                <p class="text-slate-400 truncate">{{ auth()->user()->email ?? 'user@example.com' }}</p>
                            </div>
                            <a href="#" class="block px-4 py-2 text-sm text-slate-300 hover:bg-slate-700 hover:text-white">Profilni tahrirlash</a>
                            <button @click="logoutModalOpen = true; dropdownOpen = false" type="button" class="w-full text-left block px-4 py-2 text-sm text-rose-400 hover:bg-slate-700 hover:text-rose-300 border-t border-slate-700/50 mt-1">
                                Tizimdan chiqish
                            </button>
                        </div>
                    </div>
                </div>
            </header>

            <main class="flex-1 overflow-x-hidden overflow-y-auto p-4 sm:p-6 md:p-8 z-10 relative">
                @yield('content')
            </main>

        </div>
    </div>

</body>

</html>