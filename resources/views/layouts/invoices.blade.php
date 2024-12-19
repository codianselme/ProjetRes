<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <meta name="author" content="themeholy">
        <meta name="description" content="{{config('app.name', 'DA DIGIT ALL') }} - Facture">
        <meta name="keywords" content="{{config('app.name', 'DA DIGIT ALL') }} - Facture" />
        <meta name="robots" content="INDEX,FOLLOW">
        <meta content="GestStock - Sales Inventory Admin & Dashboard " name="description" />
        <meta content="Banel SEMASSOUSSI " name="author"/>
        <meta content="+229 62 84 35 85" name="phone">

        <!-- Mobile Specific Metas -->
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <!-- Favicons - Place favicon.ico in the root directory -->
        <link rel="apple-touch-icon" sizes="57x57" href="{{ asset('assetsinvoice/img/logofaghal.png') }}">
        <link rel="apple-touch-icon" sizes="60x60" href="{{ asset('assetsinvoice/img/logofaghal.png') }}">
        <link rel="apple-touch-icon" sizes="72x72" href="{{ asset('assetsinvoice/img/logofaghal.png') }}">
        <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('assetsinvoice/img/logofaghal.png') }}">
        <link rel="apple-touch-icon" sizes="114x114" href="{{ asset('assetsinvoice/img/logofaghal.png') }}">
        <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('assetsinvoice/img/logofaghal.png') }}">
        <link rel="apple-touch-icon" sizes="144x144" href="{{ asset('assetsinvoice/img/logofaghal.png') }}">
        <link rel="apple-touch-icon" sizes="152x152" href="{{ asset('assetsinvoice/img/logofaghal.png') }}">
        <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assetsinvoice/img/logofaghal.png') }}">
        <link rel="icon" type="image/png" sizes="192x192" href="{{ asset('assetsinvoice/img/logofaghal.png') }}">
        <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assetsinvoice/img/logofaghal.png') }}">
        <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('assetsinvoice/img/logofaghal.png') }}">
        <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assetsinvoice/img/logofaghal.png') }}">
        <link rel="manifest" href="{{asset('assetsinvoice/img/favicons/manifest.json')}}">
        <meta name="msapplication-TileColor" content="#ffffff">
        <meta name="msapplication-TileImage" content="{{ asset('assetsinvoice/img/logofaghal.png') }}">
        <meta name="theme-color" content="#ffffff">

        <!--==============================
            Google Fonts
        ============================== -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@200;300;400;500;600;700;800;900;1000&display=swap" rel="stylesheet">

        <!--==============================
            All CSS File
        ============================== -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
        <!-- Bootstrap -->
        {{-- <link rel="stylesheet" href="{{asset('assetsinvoice/css/bootstrap.min.css')}}"> --}}
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
        <!-- Theme Custom CSS -->
        <link rel="stylesheet" href="{{asset('assetsinvoice/css/style.css')}}">

        <title> Facture - NORMALISER | GESTSTOCK - Admin & Dashboard </title>        @livewireStyles
    </head>

    <body class="electronics-template">

        <!-- Begin page -->
        <div class="invoice-container-wrap">
            <div class="invoice-container">

            @yield('main-content')

            </div>
            <!-- end main content-->

        </div>
        <!-- END layout-wrapper -->



    <!--==============================
    All Js File
    ============================== -->
    <!-- Jquery -->
    <script src="{{asset('assetsinvoice/js/vendor/jquery-3.6.0.min.js')}}"></script>
    <!-- Bootstrap -->
    {{-- <script src="{{asset('assetsinvoice/js/bootstrap.min.js')}}"></script> --}}

    <!-- PDF Generator -->
    <script src="{{asset('assetsinvoice/js/jspdf.min.js')}}"></script>
    <script src="{{asset('assetsinvoice/js/html2canvas.min.js')}}"></script>
    <!-- Main Js File -->
    <script src="{{asset('assetsinvoice/js/main.js')}}"></script>
        @stack('script')
        @livewireScripts
        @include('flashy::message')
        <style>
            body > div.pcr-app{
                visibility: hidden;
            }
        </style>




    </body>


</html>
