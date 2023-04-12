@extends('Layouts.layout')

@section('title', __('general.ver', ['object' => __('general.usuario')]) . ' | ' . config('app.name'))

@section('content')
    <div class="grid-x">
        <div class="small-12">
            @can('EDITAR_USUARIOS')
                {!! Html::link(
                    route('users.edit', $user->id),
                    __('general.editar', ['object' => __('general.usuario')]),
                    [
                        'escape' => false,
                        'title' => __('general.editar', ['object' => __('general.usuario')]),
                        'class' => 'button',
                    ]
                ) !!}
            @endcan
            @can('VER_USUARIOS')
                {!! Html::link(
                    route('users.ficha_user_pdf', $user->id),
                    __('general.exportar_ficha_pdf'),
                    [
                        'escape' => false,
                        'title' => __('general.exportar_ficha'),
                        'class' => 'button',
                    ]
                ) !!}
            @endcan
        </div>
        <div class="small-12">
            <table>
                <thead>
                    <tr>
                        <th colspan="2">{!! __('general.ver', ['object' => __('general.usuario')]) !!}</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th>{{ __('general.nombre') }}</th>
                        <td>{{ $user->nombre }}</td>
                    </tr>
                    <tr>
                        <th>{{ __('general.apellidos') }}</th>
                        <td>{{ $user->apellidos }}</td>
                    </tr>
                    <tr>
                        <th>{{ __('general.email') }}</th>
                        <td>{{ $user->email }}</td>
                    </tr>
                    <tr>
                        <th>{{ __('general.fecha_nacimiento') }}</th>
                        <td>{{ $user->fecha_nacimiento_formateada }}</td>
                    </tr>
                    <tr>
                        <th>{{ __('general.imagen') }}</th>
                        <td>
                            @if (isset($user->imagen))
                                {{ Html::image(Ficheros::get_url($user->imagen->id)) }}
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>{{ __('general.fichero') }}</th>
                        <td>
                            @if (isset($user->fichero))
                                {{ Html::link(
                                    Ficheros::get_url($user->fichero->id),
                                    $user->fichero->nombre,
                                    [
                                        'target' => '_blank'
                                    ]
                                ) }}
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="botones">
            {!! Html::link(route('users.index'), __('general.volver'), ['class' => 'button']) !!}
        </div>
    </div>
@endsection
