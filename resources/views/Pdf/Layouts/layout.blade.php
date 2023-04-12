<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="{{ asset_cache('css/app.css') }}" rel="stylesheet">
        <link href="{{ asset_cache('css/ionicons.min.css') }}" rel="stylesheet">
        <meta name="csrf-token" content="{{ csrf_token() }}">
    </head>
    <body>
        <div id="app">

            @include('Pdf.Elements.header')

            <div class="grid-container">
                @yield('content')
            </div>

        </div>

        <!-- Scripts -->
        <script src="{{ asset_cache('js/manifest.js') }}"></script>
        <script src="{{ asset_cache('js/vendor.js') }}"></script>
        <script src="{{ asset_cache('js/app.js') }}"></script>
        <script>
            $(document).foundation();
        </script>
    </body>
</html>
