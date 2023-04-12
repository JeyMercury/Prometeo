@extends('Layouts.layout')

@section('title', __('general.editar', ['object' => __('general.rol')]) . ' | ' . config('app.name'))

@section('content')

    <div class="grid-x">
        <div class="small-12">
            {!! Form::model($rol, [
                'url' => route('permisos.update_rol', $rol->id),
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
