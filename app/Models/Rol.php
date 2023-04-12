<?php

namespace App\Models;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class Rol extends Role
{
    /**
     * Validations
     */
        public function rules()
        {
            return [
                'name' => 'required|unique:roles,name,' . $this->id,
            ];
        }

        public static function messages()
        {
            return [
                'name.required' => __('general.validaciones.rol.name'),
                'name.unique' => __('general.validaciones.rol.unique'),
            ];
        }

    /**
     * Model methods
     */
    public function guardar($datos)
    {
        $this->name = $datos['name'];

        return $this->save();
    }

    public function guardar_permisos(Request $request)
    {
        if ($this->syncPermissions($request->request->get('permisos'))) {
            return true;
        }

        return false;
    }
}
