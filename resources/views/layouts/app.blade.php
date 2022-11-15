<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/css/custom.css','resources/js/app.js'])
    @stack('trix')
</head>

<style>
    .preload {
        opacity: 0;
        transition: .5s opacity ease-in-out;
    }

    .loaded {
        opacity: 1;
    }


</style>

<body class="font-sans antialiased ">
    <div class="min-h-screen bg-gray-100 relative">

        @include('layouts.navigation')

        <!-- Page Heading -->
        @if (isset($header))
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 ">
                    {{ $header }}
                </div>
            </header>
        @endif


        <!-- Page Content -->
        <main class="min-h-[60vh] preload">
            {{ $slot }}
        </main>
        <footer> @include('layouts.footer') </footer>
    </div>
</body>

</html>

<script>
    window.onload = function() {

        var elem = document.querySelector('.preload');


        elem.classList.add('loaded');


        // setTimeout(function() {
        //     var elem = document.querySelector('#preload');
        //     console.log('Готов!');


        // }, 200);
    }
</script>
