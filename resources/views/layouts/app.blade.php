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
    <body class="font-sans antialiased w-full">
        <div class="min-h-screen w-full bg-gray-100 dark:bg-gray-900">
            @if (Auth::guard('association')->user())               
            <!-- Page Heading -->
            @include('layouts.navigation')
            @if (isset($header))
                <header class="bg-white dark:bg-gray-800 shadow">
                    <div class="w-full mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif
            @endif


            <!-- Page Content -->
            <main class="w-full">
                {{ $slot }}
            </main>
        </div>
    </body>
</html>
