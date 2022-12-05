<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="/favicon.svg" type="image/svg+xml">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'BnB') }}</title>

    <!-- Scripts -->
    @livewireStyles
    @vite(['resources/css/web.css', 'resources/js/web.js'])

</head>
<body class="font-sans antialiased">
    <div class="bg-slate-100 min-h-screen">

        <x-layouts.web.navigation />

        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>
    </div>
    @livewireScripts
</body>
</html>
