<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>

    @livewireStyles

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://unpkg.com/@picmo/popup-picker@latest/dist/umd/picmo-popup.js"></script>
</head>

<body class="font-sans antialiased bg-neutral-50 pb-10">
<div class="min-h-screen">
    @include('layouts.navigation')


    <!-- Page Content -->
    <main class="max-w-5xl mx-auto mt-8 px-0 md:px-4">
        {{ $slot }}
    </main>
</div>

@livewireScripts
</body>

</html>
