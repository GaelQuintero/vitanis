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
    <!-- Scripts de SweetAlert2 -->
    <script src="{{ asset('lib/sweetalert/index.js') }}"></script>
    <!-- Estilos de SweetAlert2 -->
    <link rel="stylesheet" href="{{ asset('lib/sweetalert/dark.css') }}">

    <!-- DataTables CSS -->
    <link rel="stylesheet" href="{{ asset('lib/datatables/dataTables.min.css') }}">

    <!-- jQuery (ya lo tienes) -->
    <script src="{{ asset('lib/jquery/index.js') }}"></script>

    <!-- DataTables JS -->
    <script src="{{ asset('lib/datatables/dataTables.min.js') }}"></script>
    <link rel="stylesheet" href="{{asset('lib/spinner/spinner.css')}}">


    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">
    <!-- Spinner -->
    <div id="loading-spinner">
        <div class="d-flex justify-content-center">
            <div class="spinner-border" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
    </div>
    <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
        @include('layouts.navigation')

        <!-- Page Heading -->
        @isset($header)
            <header class="bg-white dark:bg-gray-800 shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endisset

        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>
    </div>
</body>
<script src="{{asset('lib/spinner/spinner.js')}}"></script>
</html>
