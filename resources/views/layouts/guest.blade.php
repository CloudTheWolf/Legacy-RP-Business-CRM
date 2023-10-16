<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ Config('app.APP_NAME') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdn.lineicons.com/4.0/lineicons.css" />


        <!-- Scripts -->
        @if (app()->runningInConsole())
            <!-- Include Vite assets for development -->
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @else
            <link rel="stylesheet" href="{{ asset('/css/app.css') }}">
            <script src="{{ asset('js/app.js') }}"></script>
            <script src="{{ asset('js/app2.js') }}"></script>
        @endif

        <!-- Styles -->
        @livewireStyles

        <style>
            .fixed-background
            {
                background:url({{url('/assets/images/branding')}}/{{config('app.brandingPath')}}/bg.png) no-repeat 50% fixed !important;
                background-size:cover;
                width:100%;height:100%;
                position:fixed;
                top:0;
                right:0;
                bottom:0;
                left:0 ;
            }
        </style>
    </head>
    <body>
        <div class="font-sans text-gray-900 dark:text-gray-100 antialiased">
            {{ $slot }}
        </div>

        @livewireScripts
    </body>
</html>
