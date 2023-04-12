@extends('Layouts.layout')

@section('title', __('general.roles') . ' | ' . config('app.name'))

@section('content')
    <div class="grid-x">
        <div class="small-12">
            @canor('EDITAR_PERMISOS_ROL')
                {{ Html::link(
                    route('permisos.create_rol'),
                    __('general.nuevo', ['object' => __('general.rol')]),
                    [
                        'class' => 'button right'
                    ]
                ) }}
            @endcanor
        </div>
        <div class="small-12">
            <table>
                <thead>
                    <tr>
                        <th>{{ __('general.nombre') }}</th>
                        @canor('EDITAR_PERMISOS_ROL')
                            <th>{{ __('general.acciones') }}</th>
                        @endcanor
                    </tr>
                </thead>
                <tbody>
                    @foreach ($roles as $rol)
                        <tr>
                            <td>{{ $rol->name }}</td>
                            @can('EDITAR_PERMISOS_ROL')
                                <td>
                                    @can('EDITAR_PERMISOS_ROL')
                                        @if ($rol->id != config('constants_permission.ROLES.ID.ADMINISTRADOR'))
                                            {!! Html::link(
                                                route('permisos.edit_rol', $rol->id),
                                                Html::icon('icon ion-md-create'),
                                                [
                                                    'escape' => false,
                                                    'title' => __('general.editar', ['object' => __('general.rol')]),
                                                ]
                                            ) !!}
                                        @endif
                                        @if ($rol->id != config('constants_permission.ROLES.ID.ADMINISTRADOR'))
                                            {!! Html::link(
                                                route('permisos.edit_rol_permission', $rol->id),
                                                Html::icon('icon ion-md-key'),
                                                [
                                                    'escape' => false,
                                                    'title' => __('general.editar', ['object' => __('general.permisos')]),
                                                ]
                                            ) !!}
                                        @endif
                                    @endcan
                                </td>
                            @endcan
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>


@endsection
