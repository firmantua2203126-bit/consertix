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
    <body class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen flex items-center justify-center bg-gray-100 dark:bg-gray-900 p-6">
            <div class="w-full max-w-5xl bg-white rounded-2xl shadow-lg overflow-hidden flex flex-col md:flex-row">

                <!-- LEFT: form -->
                <div class="md:w-1/2 p-8">
                    <div class="mb-6">
                        <a href="/">
                            <x-application-logo class="w-24 h-24 fill-current text-indigo-600" />
                        </a>
                    </div>

                    <div class="">{{ $slot }}</div>
                </div>

                <!-- RIGHT: image + welcome text -->
                <div class="md:w-1/2 bg-cover bg-center relative" style="background-image: url('{{ asset('logo/banner1.png') }}')">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                    <div class="relative z-10 flex items-center justify-center h-full p-8">
                        <div class="text-white text-center">
                            <h2 class="text-3xl font-bold mb-2">Welcome Back</h2>
                            <p class="opacity-90">Access your personal account by logging in</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </body>
</html>
