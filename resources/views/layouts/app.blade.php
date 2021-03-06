<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->

        <!-- Styles -->
        <link rel="shortcut icon" type="image/png" href="https://senacertificados.co/wp-content/uploads/2021/10/2090px-Sena_Colombia_logo.svg_-300x294.png">
        <link rel="shortcut icon" sizes="192x192" href="https://senacertificados.co/wp-content/uploads/2021/10/2090px-Sena_Colombia_logo.svg_-300x294.png">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
        <link rel="stylesheet" href="https://unpkg.com/flowbite@1.4.1/dist/flowbite.min.css" />
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">

        @livewireStyles

        <!-- Scripts -->
        {{-- <script defer src="https://unpkg.com/alpinejs@3.9.3/dist/cdn.min.js"></script> --}}
        <script src="{{ mix('js/app.js') }}" defer></script>
    </head>
    <body class="font-sans antialiased">
        <x-jet-banner />

        <div class="min-h-screen bg-gray-100">
            @livewire('navigation-menu')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow">
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
        <script src="https://unpkg.com/flowbite@1.4.1/dist/flowbite.js"></script>
        {{-- <script defer src="https://unpkg.com/alpinejs@3.9.3/dist/cdn.min.js"></script> --}}

        @livewireScripts
    </body>
</html>
