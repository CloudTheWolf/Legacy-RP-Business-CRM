<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ Config('app.APP_NAME') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdn.lineicons.com/4.0/lineicons.css" />
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

        <link rel="icon" type="image/png" href="{{url('/assets/images/branding')}}/{!! config('app.brandingPath') !!}/logo-icon2.png">

        <!-- Scripts -->
        @if (config('app.url') == 'http://localhost:8000')
            <!-- Include Vite assets for development -->
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @else
            <link rel="stylesheet" href="{{ asset('styles/css/app.css') }}">
            <script src="{{ asset('styles/js/app.js') }}"></script>
            <script src="{{ asset('styles/js/app2.js') }}"></script>
        @endif

        <style>
            /* width */
            ::-webkit-scrollbar {
                width: 10px;
            }

            /* Track */
            ::-webkit-scrollbar-track {
                background: #f1f1f1;
            }

            /* Handle */
            ::-webkit-scrollbar-thumb {
                background: #888;
            }

            /* Handle on hover */
            ::-webkit-scrollbar-thumb:hover {
                background: #555;
            }

            .disable-link {
                pointer-events: none; /* Makes the link not clickable */
            }

            .disable-link::after {
                content: "";
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: rgba(91, 91, 91, 0.71); /* Grey overlay with 50% opacity */
                z-index: 999; /* Ensure the overlay is above the link content */
            }

            .apexcharts-svg {
                background-color: transparent !important;
            }

        </style>

        <!-- Styles -->
        @livewireStyles

        <style>
            .fixed-background
            {
                background-color: rgb(22, 24, 42);
            }
        </style>
    </head>
    <body>
        <div class="font-sans text-gray-900 dark:text-gray-100 antialiased">
            {{ $slot }}
        </div>

        @livewireScripts

        @yield('js_page')

    </body>
</html>
