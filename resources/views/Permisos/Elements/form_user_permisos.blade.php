<div class="grid-x">
    <table>
        <thead>
            <tr>
                <th>{{ __('general.permisos') }}</th>
                <th>{{ __('general.incluido') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($permisos as $permiso)
                <tr>
                    <td>{{ $permiso->name }}</td>
                    @php
                        $valor = null;
                        foreach ($permisos_user_directos as $permiso_user_directo) {
                            if ($permiso_user_directo->name == $permiso->name) {
                                $valor = 1;
                            }
                        }
                        $disabled = false;
                        foreach ($permisos_user_from_rol as $permiso_user_from_rol) {
                            if ($permiso_user_from_rol->name == $permiso->name) {
                                $disabled = true;
                                $valor = 1;
                            }
                        }
                    @endphp
                    <td>
                        {{ Form::checkbox(
                            'permisos.' . $permiso->id,
                            $permiso->id,
                            $valor,
                            [
                                'label' => false,
                                'disabled' => $disabled
                            ]
                        ) }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="botones">
        {!! Html::link(route('users.index'), __('general.cancelar'), ['class' => 'secondary  button']) !!}
        {!! Form::submit(__('general.guardar'), ['class' => 'button']) !!}
    </div>
</div>
