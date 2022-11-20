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

    .bg2{
        background: url("/img/right.webp")top right no-repeat fixed,
         url("/img/left.webp")top left no-repeat fixed ;
    }

</style>

<body class="font-sans antialiased ">
    <div class="min-h-screen bg2 relative">

        @include('layouts.navigation')




        <!-- Page Content -->
        <main class=" min-h-[60vh] ">
            <div id="wrap" class="max-w-7xl  mx-auto p-4 min-h-[60vh] bg-white">
                <div class="preload">
                    {{ $slot }}

                </div>
            </div>

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
