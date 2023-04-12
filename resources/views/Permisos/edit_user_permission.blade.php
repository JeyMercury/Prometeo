@extends('Layouts.layout')

@section('title', __('general.editar', ['object' => __('general.permisos') . ' ' . __('general.usuario')]) . ' | ' . config('app.name'))

@section('content')

    <div class="grid-x">
        <div class="titulo small-12">
            {{ $user->nombre }}
        </div>
        <div class="small-12">
            {!! Form::open([
                'url' => route('permisos.update_user_permission', $user->id),
                'method' => 'PUT',
                'files' => false,
                'class' => 'form-horizontal',
                'id' => 'formulario',
            ]) !!}
                @include('Permisos.Elements.form_user_permisos')
            {{ Form::close() }}
        </div>
    </div>

@endsection
