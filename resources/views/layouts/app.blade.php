<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-100">
    <div class="min-h-screen flex">

    <!-- Sidebar -->
    <aside class="w-64 bg-white shadow-md h-screen fixed">
        <div class="p-6">
            <h2 class="text-xl font-bold text-black-800 mb-4 text-center">Admin</h2>
            <nav class="space-y-2">
                <a href="{{ route('dashboard') }}" class="block px-4 py-2 rounded hover:bg-gray-200">Dashboard</a>

                <!-- Dropdown Menu -->
                <div x-data="{ open: false }" class="px-4 py-2 cursor-pointer rounded hover:bg-gray-200">
                    <div @click="open = !open" class="flex justify-between items-center">
                        Website Management
                        <svg :class="{ 'rotate-180': open }" class="w-4 h-4 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </div>
                    <ul x-show="open" x-transition class="mt-2 pl-4 space-y-1">
                        <li>
                            <a href="{{ route('slider.index') }}" class="block py-1 px-2 rounded hover:bg-gray-100">Home Page Slider</a>
                        </li>
                    </ul>
                </div>

            </nav>
        </div>
    </aside>

    <!-- Main Content -->
    <div class="flex-1 ml-64 flex flex-col h-screen">
        <!-- Navigation/Header -->
        @include('layouts.navigation')

        <!-- Page Heading -->
        @if (isset($header))
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endif

        <!-- Scrollable Main -->
        <main class="flex-1 overflow-y-auto p-6 bg-gray-100">
            @yield('content')
        </main>
    </div>


        </div>
    </div>
</body>
</html>
