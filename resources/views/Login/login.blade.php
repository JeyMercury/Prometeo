@extends('Layouts.layout_login')

@section('content')

<div class="row">

    <div class="form-container small-6 small-centered columns">

        <div class="form-title text-center">
            {{__('general.login.login')}}
        </div>

        <form class="login-form" method="POST" action="{{ route('login') }}">

            {{ csrf_field() }}

            <div class="email">
                <label for="username">{{ __('general.login.username') }}</label>

                <input id="username" type="text" name="username" value="{{ old('username') }}" aria-describedby="usernameHelpText" required autofocus>

                @if ($errors->has('username'))
                    <span class="help-text" id="usernameHelpText">
                        <strong>{{ $errors->first('username') }}</strong>
                    </span>
                @endif
            </div>

            <div class="password">
                <label for="password">{{ __('general.login.password') }}</label>

                <input id="password" type="password" name="password" aria-describedby="passwordHelpText" required>

                @if ($errors->has('password'))
                    <span class="help-text" id="passwordHelpText">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
            </div>

            <div class="checkbox">
                <label>
                    <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> {{ __('general.login.remember_me') }}
                </label>
            </div>

            <div class="button-plus-link">
                <button type="submit" class="button">
                    {{ __('general.login.login') }}
                </button>

                <a href="{{ route('password.request') }}">
                    &nbsp;
                    {{ __('general.login.has_olvidado_la_contraseña') }}
                </a>
            </div>
        </form>

    </div>

</div>
@endsection
