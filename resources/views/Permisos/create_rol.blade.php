@extends('Layouts.layout')

@section('title', __('general.nuevo', ['object' => __('general.rol')]) . ' | ' . config('app.name'))

@section('content')

    <div class="grid-x">
        <div class="small-12">
            {!! Form::open([
                'url' => route('permisos.store_rol'),
                'method' => 'POST',
                'files' => false,
                'class' => 'form-horizontal',
                'id' => 'formulario',
                'name' => 'user',
            ]) !!}
                @include('Permisos.Elements.form_rol')
            {{ Form::close() }}
        </div>
    </div>

@endsection
