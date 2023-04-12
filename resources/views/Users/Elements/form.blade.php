<div class="grid-x">
    <div class="small-12">
        <div class="grid-x">
            <div class="small-12">
                {{ Form::input(
                    'text',
                    'username',
                    null,
                    [
                        'label' => __('general.username')
                    ]
                ) }}
            </div>
        </div>
        @if (!isset($user))
            <div class="grid-x">
                <div class="small-12">
                    {{ Form::input(
                        'password',
                        'password',
                        null,
                        [
                            'label' => __('general.password')
                        ]
                    ) }}
                </div>
            </div>
        @endif
        <div class="grid-x">
            <div class="small-12">
                {{ Form::input(
                    'text',
                    'nombre',
                    null,
                    [
                        'label' => __('general.nombre')
                    ]
                ) }}
            </div>
        </div>
        <div class="grid-x">
            <div class="small-12">
                {{ Form::input(
                    'text',
                    'apellidos',
                    null,
                    [
                        'label' => __('general.apellidos')
                    ]
                ) }}
            </div>
        </div>
        <div class="grid-x">
            <div class="small-12">
                {{ Form::input(
                    'email',
                    'email',
                    null,
                    [
                        'label' => __('general.email')
                    ]
                ) }}
            </div>
        </div>
        <div class="grid-x">
            <div class="small-12">
                <select-fecha
                    name_input_js="fecha_nacimiento"
                    idioma="{{ config('app.locale') }}"
                    formato="{{ constants('FORMATOS_FECHA.USUARIO_CORTA_VUE') }}"
                    value="{{ antiguo_valor_fecha('fecha_nacimiento', @$user->fecha_nacimiento) }}"
                    name_label_js="{{ __('general.fecha_nacimiento') }}"
                    placeholder="" />
            </div>
        </div>
        @if (isset($user))
            <div class="grid-x">
                <div class="small-12">
                    {{ Form::checkbox('activo', 1, null, ['label' => __('general.activo')]) }}
                </div>
            </div>
        @endif
        <div class="grid-x">
            <div class="small-6">
                <input-drag-drop input_name="imagen" input_text="Arrastrar y soltar elementos aquí"
                    label_text={{ __('general.imagen') }}></input-drag-drop>
            </div>
            @if (isset($user->imagen))
                <div class="small-2">
                    {{ Form::label(__('general.imagen_actual')) }}
                    {{ Html::image(Ficheros::get_url($user->imagen->id)) }}
                    <sweet-alert-confirmar
                        elemento_id="{{ $user->id }}"
                        url_api="{{ route('users.destroy_imagen', $user->id) }}"
                        subtitulo="{{ __('general.constants_text.SWAL.BORRAR.TITULO') }}"
                        boton_si="{{ __('general.aceptar') }}" boton_no="{{ __('general.cancelar') }}"
                        :reload="true">
                    </sweet-alert-confirmar>
                </div>
            @endif
        </div>
        <div class="grid-x">
            <div class="small-6">
                <input-drag-drop
                    input_name="fichero"
                    input_text="Arrastrar y soltar elementos aquí"
                    label_text="{{ __('general.fichero') }}">
                </input-drag-drop>
            </div>
            @if (isset($user->fichero))
                <div class="small-4">
                    {{ Form::label(__('general.fichero_actual')) }}
                    {{ Html::link(Ficheros::get_url($user->fichero->id), $user->fichero->nombre) }}
                    <sweet-alert-confirmar
                        elemento_id="{{ $user->id }}"
                        url_api="{{ route('users.destroy_fichero', $user->id) }}"
                        subtitulo="{{ __('general.constants_text.SWAL.BORRAR.TITULO') }}"
                        boton_si="{{ __('general.aceptar') }}"
                        boton_no="{{ __('general.cancelar') }}"
                        :reload="true">
                    </sweet-alert-confirmar>
                </div>
            @endif
        </div>
    </div>
    <div class="botones">
        {!! Html::link(route('users.index'), __('general.cancelar'), ['class' => 'secondary  button']) !!}
        {!! Form::submit(__('general.guardar'), ['class' => 'button']) !!}
    </div>
</div>
