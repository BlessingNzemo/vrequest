<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{ asset('img/orange.png') }}" type="image/x-icon">

    <title>{{ $title ?? 'Projet' }}</title>
    <style>
        .icon {
            font-size: 32px;
            color: white;
            transition: color 0.3s ease;
        }

        .icon.white {
            color: white;
        }
    </style>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- link openStreetMap-->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.3/themes/base/jquery-ui.css">

    <!-- Link data Tables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.dataTables.css">

    <!-- jquery-->
    <link rel="stylesheet" href="jquery.typeahead.css">
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
        crossorigin="anonymous"></script>

    <!-- scripts data Tables -->
    <script src="https://cdn.datatables.net/2.0.8/js/dataTables.js"></script>

    <!--scripts openStreetmap-->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

    <script src="../path/to/flowbite/dist/flowbite.min.js"></script>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<style>
    .sm\:creater-size{
        font-size: 70%
    }
    .sm\:flex-button{
        display:inline-flex;
    }
    @media (max-width: 1000px) {
        .sm\:creater-size{
            font-size: 50%
        }
        .sm\:flex-button{
            display:unset;
        }
        .sm-w-8{
            width: 1rem;
        }
        .sm-h-8{
            height: 1rem;
        }
    }
    @media (max-width: 400px) {
        .sm-grid-cols-1 {
            grid-template-columns: repeat(1,minmax(0,1fr))!important
        }
    }
    @media (min-width: 500px) and (max-width: 1100px) {
        .sm-grid-cols-2 {
            grid-template-columns: repeat(2,minmax(0,1fr))!important
        }
    }
    @media (min-width: 1100px) and (max-width: 1300px) {
        .sm-grid-cols-3 {
            grid-template-columns: repeat(3,minmax(0,1fr))!important
        }
    }
    @media (min-width: 1300px) and (max-width: 1600px) {
        .sm-grid-cols-4 {
            grid-template-columns: repeat(4,minmax(0,1fr))!important
        }
    }
    @media (min-width: 1600px) {
        .sm-grid-cols-5 {
            grid-template-columns: repeat(5,minmax(0,1fr))!important
        }
    }
    .dark\:bg-dark{
        background-color: rgb(17 24 39);
    }

    .dark\:text-dark{
        color:white;
    }
 </style>
<body class=" bg-gray-50 font-sans antialiased">
    <div class="min-h-screen  dark:bg-gray-900">
        @include('layouts.navigation')
        <div class="p-4 sm:ml-64 mt-10">



            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white dark:bg-gray-800 shadow">
                     <div class="max-w-7xl mb-10 mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div> 
                </header>
            @endif

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
    </div>

</body>

</html>
