@extends('Layouts.layout')

@section('title', __('general.editar', ['object' => __('general.usuario')]) . ' | ' . config('app.name'))

@section('content')
    <div class="grid-x">
        <div class="small-12">
            {!! Form::model($user, [
                'url' => route('users.update', $user->id),
                'method' => 'PUT',
                'files' => true,
                'class' => 'form-horizontal',
                'id' => 'formulario',
            ]) !!}
                @include('Users.Elements.form')
            {{ Form::close() }}
        </div>
    </div>
@endsection
