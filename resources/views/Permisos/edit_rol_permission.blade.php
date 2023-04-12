@extends('Layouts.layout')

@section('title', __('general.editar', ['object' => __('general.permisos') . ' ' . __('general.rol')]) . ' | ' . config('app.name'))

@section('content')

    <div class="grid-x">
        <div class="titulo small-12">
            {{ $rol->name }}
        </div>
        <div class="small-12">
            {!! Form::open([
                'url' => route('permisos.update_rol_permission', $rol->id),
                'method' => 'PUT',
                'files' => false,
                'class' => 'form-horizontal',
                'id' => 'formulario',
            ]) !!}
                @include('Permisos.Elements.form_rol_permisos')
            {{ Form::close() }}
        </div>
    </div>


@endsection
