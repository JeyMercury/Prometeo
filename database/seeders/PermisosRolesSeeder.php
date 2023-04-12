<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class PermisosRolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //---------------------------------
        //  EMPLEADO
        //---------------------------------

        $role = Role::find(config('constants_permission.ROLES.ID.EMPLEADO'));

        // Asignar varios permisos
        $permissions = [
            config('constants_permission.PERMISOS.ID.VER_USUARIOS'),
        ];

        $role->syncPermissions($permissions);
    }
}
