@extends('Layouts.layout')

@section('title', __('general.nuevo', ['object' => __('general.usuario')]) . ' | ' . config('app.name'))

@section('content')
    <div class="grid-x">
        <div class="small-12">
            {!! Form::open([
                'url' => route('users.store'),
                'method' => 'POST',
                'files' => true,
                'class' => 'form-horizontal',
                'id' => 'formulario',
                'name' => 'user',
            ]) !!}
                {!! Honeypot::generate('my_name', 'my_time') !!}
                @include('Users.Elements.form')
            {{ Form::close() }}
        </div>
    </div>
@endsection
