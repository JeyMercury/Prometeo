@extends('Layouts.layout_login')

@section('content')

<div class="container">

    <div class="row">

        <div class="form-container small-6 small-centered columns">

            <div class="status_message">
                @if (session('status'))
                    <div class="callout">
                        {{ session('status') }}
                    </div>
                @endif
            </div>

            <div class="form-title text-center">
                {{ __('general.login.reset_password') }}
            </div>

            <form class="forgot-password-form" method="POST" action="{{ route('password.email') }}">

                {{ csrf_field() }}

                <div class="username">
                    <label for="username">{{ __('general.email') }}</label>

                    <input id="username" type="username" name="email" value="{{ old('username') }}" aria-describedby="usernameHelpText" required autofocus>

                    @if ($errors->has('username'))
                        <span class="help-text" id="usernameHelpText">
                            <strong>{{ $errors->first('username') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="send-button">
                    <button type="submit" class="button">
                        {{ __('general.login.enviar_link') }}
                    </button>
                </div>

            </form>

        </div>

    </div>

</div>

@endsection
