<!DOCTYPE html>
<html lang="uz" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Xush kelibsiz') | EduNova</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body
    class="font-sans antialiased bg-slate-900 text-slate-200 flex flex-col min-h-screen selection:bg-blue-500 selection:text-white">

    {{-- Main Content --}}
    <main class="flex-grow w-full">
        @yield('content')
    </main>

</body>

</html>