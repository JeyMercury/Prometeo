<?php

namespace App\Http\Resources;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'nombre' => $this->nombre,
            'apellidos' => $this->apellidos,
            'email' => $this->email,
            'fecha_nacimiento' => isset($this->fecha_nacimiento)
                ? $this->fecha_nacimiento->format(constants('FORMATOS_FECHA.USUARIO_CORTA'))
                : '',
            'roles' => $this->getRoleNames()->implode(', '),
            'acciones' => $this->getActions($request)
        ];
    }

    protected function getActions($request)
    {
        $acciones = array();
        $user = Auth::user();
        if ($user->can('VER_USUARIOS')) {
            $acciones[] = array(
                'ruta' => route('users.show', $this->id),
                'icono' => 'icon ion-md-eye',
                'title' => __('general.ver', ['object' => __('general.usuario')]),
                'type' => 'link'
            );
        }
        if ($user->can('EDITAR_USUARIOS')) {
            $acciones[] = array(
                'ruta' => route('users.edit', $this->id),
                'icono' => 'icon ion-md-create',
                'title' => __('general.editar', ['object' => __('general.usuario')]),
                'type' => 'link'
            );
        }
        if (!in_array(config('constants_permission.ROLES.NOMBRE.ADMINISTRADOR'), $this->getRoleNames()->toArray())) {
            if ($user->can('EDITAR_PERMISOS_USUARIO')) {
                $acciones[] = array(
                    'url_api' => route('users.destroy', $this->id),
                    'elemento_id' => (string)$this->id,
                    'title' => __('general.eliminar', ['object' => __('general.usuario')]),
                    'subtitulo' => __('general.constants_text.SWAL.BORRAR.TITULO'),
                    'boton_si' => __('general.aceptar'),
                    'boton_no' => __('general.cancelar'),
                    'reload' => true,
                    'type' => 'sweet-alert'
                );
            }
            if ($user->can('EDITAR_PERMISOS_USUARIO')) {
                $acciones[] = array(
                    'ruta' => route('permisos.edit_user_permission', $this->id),
                    'icono' => 'icon ion-md-key',
                    'title' => __('general.editar', ['object' => __('general.permisos')]),
                    'type' => 'link'
                );
            }
            if ($user->can('EDITAR_ROLES_USUARIO')) {
                $acciones[] = array(
                    'ruta' => route('permisos.edit_user_rol', $this->id),
                    'icono' => 'icon ion-md-cog',
                    'title' => __('general.editar', ['object' => __('general.roles')]),
                    'type' => 'link'
                );
            }
        }
        return $acciones;
    }
}
