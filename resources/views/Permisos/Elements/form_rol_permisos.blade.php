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
                        foreach ($permisos_rol as $permiso_rol) {
                            if ($permiso_rol->name == $permiso->name) {
                                $valor = 1;
                            }
                        }
                    @endphp
                    <td>{{ Form::checkbox('permisos.' . $permiso->id, $permiso->id, $valor, ['label' => false]) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="botones">
        {!! Html::link(route('permisos.index'), __('general.cancelar'), ['class' => 'secondary  button']) !!}
        {!! Form::submit(__('general.guardar'), ['class' => 'button']) !!}
    </div>
</div>
