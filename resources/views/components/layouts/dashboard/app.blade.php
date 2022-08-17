<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="/favicon.svg" sizes="any" type="image/svg+xml">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', config('app.name')) | {{ config('app.name') }} </title>
    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>
    @livewireStyles

    @vite(['resources/css/dashboard.css', 'resources/js/dashboard.js'])
    @stack('header')
</head>

<body class="w-full min-h-screen overflow-x-hidden font-sans antialiased bg-slate-100">

    <div x-cloak x-data="{ sidebar: $persist(true), sidebarWindow: new TouchSweep(sidebarWindow) }" x-init="window.innerWidth <= 768 ? sidebar = false : sidebar = true" class="relative flex items-start ">
        <x-layouts.dashboard.navbar />
        <x-layouts.dashboard.sidebar />
        <main :class="{ 'sm:pl-60': sidebar, 'sm:pl-0': !sidebar }" class="flex flex-col w-full transition-all duration-300 sm:pl-60 md:flex-row md:min-h-screen">
            <div class="w-full max-w-screen-md px-4 py-10 text-gray-600 lg:px-10 md:max-w-full">
                {{ $slot }}
            </div>
        </main>
    </div>

    @livewireScripts
    <livewire:toasts />
</body>

</html>
