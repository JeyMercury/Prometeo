@extends('Layouts.layout')
@section('content')
    <div class="container">
        <div class="grid-x grid-padding-x m-top-standard">
            <div class="cell">
                <h1>{{ __('general.header.calendario') }}</h1>
            </div>
        </div>
        <div class="grid-x grid-padding-x">
            <div class="cell position-relative">
                <calendario idioma="{{ config('app.locale') }}"></calendario>
            </div>
        </div>
    </div>
@endsection
