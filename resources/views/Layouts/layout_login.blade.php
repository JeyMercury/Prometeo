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

        {{-- top bar --}}
        <div class="top-bar">

            <div class="top-bar-left">
                <ul class="dropdown menu" data-dropdown-menu>
                    <li class="menu-text">{{ config('app.name') }}</li>
                </ul>
            </div>

            <div class="top-bar-right">
                <ul class="menu">
                    @if (Auth::guest())
                        <li><a href="{{ route('login') }}">{{ __('general.login.login') }}</a></li>
                    @else
                        <ul class="dropdown menu" data-dropdown-menu>
                            <li>
                                <a href="#">{{ $user_auth->username }}</a>
                                <ul class="menu">
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                            style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    @endif
                </ul>
            </div>

        </div>

        @yield('content')

    </div>

    <!-- Scripts -->
    <script src="{{ asset_cache('js/libraries.js') }}"></script>
    <script src="{{ asset_cache('js/app.js') }}"></script>
    <script>$(document).foundation();</script>
</body>

</html>
