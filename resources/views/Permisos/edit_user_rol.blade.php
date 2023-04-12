@extends('Layouts.layout')

@section('title', __('general.editar', ['object' => __('general.roles') . ' ' . __('general.usuario')]) . ' | ' . config('app.name'))

@section('content')

    <div class="grid-x">
        <div class="titulo small-12">
            {{ $user->nombre }}
        </div>
        <div class="small-12">
            {!! Form::open([
                'url' => route('permisos.update_user_rol', $user->id),
                'method' => 'PUT',
                'files' => false,
                'class' => 'form-horizontal',
                'id' => 'formulario',
            ]) !!}
                <div class="grid-x">
                    <table>
                        <thead>
                            <tr>
                                <th>{{ __('general.permisos') }}</th>
                                <th>{{ __('general.incluido') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($roles as $rol)
                                <tr>
                                    <td>{{ $rol->name }}</td>
                                    @php
                                        $valor = null;
                                        foreach ($roles_user as $rol_user) {
                                            if ($rol_user == $rol->name) {
                                                $valor = 1;
                                            }
                                        }
                                    @endphp
                                    <td>
                                        {{ Form::checkbox('roles.' . $rol->id, $rol->id, $valor, ['label' => false]) }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="botones">
                        {!! Html::link(
                            route('users.index'),
                            __('general.cancelar'),
                            [
                                'class' => 'secondary button'
                            ]
                        ) !!}
                        {!! Form::submit(__('general.guardar'), ['class' => 'button']) !!}
                    </div>
                </div>
            {{ Form::close() }}
        </div>
    </div>


@endsection
