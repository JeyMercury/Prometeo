@extends('Layouts.layout')

@section('title', __('general.usuarios') . ' | ' . config('app.name'))

@section('content')
    <div class="grid-x">
        <div class="small-12">
            @can('CREAR_USUARIOS')
                {{ Html::link(
                    route('users.create'),
                    __('general.nuevo', ['object' => __('general.usuario')]),
                    [
                        'class' => 'button right',
                    ]
                ) }}
            @endcan
            @can('VER_USUARIOS')
                {!! Html::link(
                    route('users.exportar'),
                    __('general.exportar_tabla_excel'),
                    [
                        'escape' => false,
                        'class' => 'button right',
                    ]
                ) !!}
            @endcan
        </div>
        <div class="small-12">
            <data-table
                fetch-url="{{ route('users.datatable') }}"
                :columns="[{
                        key: 'nombre',
                        text: '{{ __('general.nombre') }}',
                        order_column: 'nombre'
                    },
                    {
                        key: 'apellidos',
                        text: '{{ __('general.apellidos') }}',
                        order_column: 'apellidos'
                    },
                    {
                        key: 'email',
                        text: '{{ __('general.email') }}',
                        order_column: 'email'
                    },
                    {
                        key: 'fecha_nacimiento',
                        text: '{{ __('general.fecha_nacimiento') }}',
                        order_column: 'fecha_nacimiento'
                    },
                    {
                        key: 'roles',
                        text: '{{ __('general.roles') }}',
                        order_column: null
                    },
                    {
                        key: 'acciones',
                        text: '{{ __('general.acciones') }}',
                        order_column: null
                    }
                ]"
                :buscador="true"
                buscador_label="{{ __('general.textos.buscador_users') }}"
                request={{ $buscador }}>
            </data-table>
        </div>
    </div>
@endsection
