<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdn.lineicons.com/4.0/lineicons.css" />
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" />

        <link rel="icon" type="image/png" href="{{url('/assets/images/branding')}}/{!! config('app.brandingPath') !!}/logo-icon2.png">

        <!-- Scripts -->

        @if (config('app.url') == 'http://localhost:8000')
            <!-- Include Vite assets for development -->
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @else
            <link rel="stylesheet" href="{{ asset('/styles/css/app.css') }}?v={{\Carbon\Carbon::now()->timestamp}}">
            <script src="{{ asset('/styles/js/app2.js') }}?v={{\Carbon\Carbon::now()->timestamp}}"></script>
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
    </head>
    <body class="font-sans antialiased">
        <x-banner />

        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
            @livewire('navigation-menu')

            @if(!Config('app.is-stable'))
                <div class="p-4 text-sm text-center text-gray-50 bg-red-500" role="alert">
                    <span class="font-medium">Error!</span> Config table missing. Did you remember to run "<code>php artisan migrate</code>"?
                </div>
            @endif

            <!-- Page Heading -->

            @if (isset($header))
                <header class="bg-white dark:bg-gray-800 shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>

        @stack('modals')

        @livewireChartsScripts

    </body>
</html>
