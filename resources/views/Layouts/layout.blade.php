<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }} {{ app()->version() }}</title>

    <!-- Styles -->
    <link href="{{ asset_cache('css/libraries.css') }}" rel="stylesheet">
    <link href="{{ asset_cache('css/app.css') }}" rel="stylesheet">
</head>

<body>
    <div id="app">
        @include('Layouts.Elements.header')

        @include('Elements.sesion_mensajes')

        @include('Layouts.Elements.sidebar')

        <div class="grid-container margin-top-1">
            @yield('content')
        </div>

    </div>

    <!-- Scripts -->
    <script src="{{ asset_cache('js/libraries.js') }}"></script>
    <script src="{{ asset_cache('js/app.js') }}"></script>
    <script>$(document).foundation();</script>
</body>

</html>
