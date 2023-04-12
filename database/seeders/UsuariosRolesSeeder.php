<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsuariosRolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::find(1);
        $user->assignRole(config('constants_permission.ROLES.NOMBRE.ADMINISTRADOR'));

        $user = User::find(2);
        $user->assignRole(config('constants_permission.ROLES.NOMBRE.EMPLEADO'));
    }
}
