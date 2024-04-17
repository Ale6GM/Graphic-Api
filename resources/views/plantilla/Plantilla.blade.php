<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-bs-theme="dark">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('titulo')</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="{{asset('assets/css/estilos.css')}}">
        <link rel="stylesheet" href="{{asset('assets/css/sweetalert2.css')}}">
        @vite(['resources/scss/app.scss', 'resources/js/app.js'])
        <!-- Styles -->
        <style>
          
        </style>
    </head>
    <body>

        @include('plantilla.componente.header')
        @yield('contenido')

        @include('plantilla.componente.footer')

        <script src="{{asset('assets/js/package/dist/chart.umd.js')}}"></script>
        <script src="{{asset('assets/js/app.js')}}"></script>
        <script src="{{asset('assets/js/sweetalert2.min.js')}}"></script>
        <script src="{{asset('assets/js/es6-promise.js')}}"></script>
        <script src="{{asset('assets/js/jspdf.umd.min.js')}}"></script>
        <script src="{{asset('assets/js/html2canvas.js')}}"></script>
        <script src="{{asset('assets/js/html2pdf.bundle.min.js')}}"></script>
    </body>
</html>