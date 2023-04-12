<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermisosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Permission::create([
            'id' => config('constants_permission.PERMISOS.ID.VER_USUARIOS'),
            'name' => config('constants_permission.PERMISOS.NOMBRE.VER_USUARIOS'),
            'orden' => 1,
        ]);

        Permission::create([
            'id' => config('constants_permission.PERMISOS.ID.CREAR_USUARIOS'),
            'name' => config('constants_permission.PERMISOS.NOMBRE.CREAR_USUARIOS'),
            'orden' => 1,
        ]);

        Permission::create([
            'id' => config('constants_permission.PERMISOS.ID.EDITAR_USUARIOS'),
            'name' => config('constants_permission.PERMISOS.NOMBRE.EDITAR_USUARIOS'),
            'orden' => 1,
        ]);

        Permission::create([
            'id' => config('constants_permission.PERMISOS.ID.ELIMINAR_USUARIOS'),
            'name' => config('constants_permission.PERMISOS.NOMBRE.ELIMINAR_USUARIOS'),
            'orden' => 1,
        ]);

        Permission::create([
            'id' => config('constants_permission.PERMISOS.ID.VER_PERMISOS'),
            'name' => config('constants_permission.PERMISOS.NOMBRE.VER_PERMISOS'),
            'orden' => 2,
        ]);

        Permission::create([
            'id' => config('constants_permission.PERMISOS.ID.EDITAR_PERMISOS_USUARIO'),
            'name' => config('constants_permission.PERMISOS.NOMBRE.EDITAR_PERMISOS_USUARIO'),
            'orden' => 2,
        ]);

        Permission::create([
            'id' => config('constants_permission.PERMISOS.ID.EDITAR_PERMISOS_ROL'),
            'name' => config('constants_permission.PERMISOS.NOMBRE.EDITAR_PERMISOS_ROL'),
            'orden' => 2,
        ]);

        Permission::create([
            'id' => config('constants_permission.PERMISOS.ID.EDITAR_ROLES_USUARIO'),
            'name' => config('constants_permission.PERMISOS.NOMBRE.EDITAR_ROLES_USUARIO'),
            'orden' => 2,
        ]);

        Permission::create([
            'id' => config('constants_permission.PERMISOS.ID.VER_ESTADISTICAS'),
            'name' => config('constants_permission.PERMISOS.NOMBRE.VER_ESTADISTICAS'),
            'orden' => 3,
        ]);
    }
}
