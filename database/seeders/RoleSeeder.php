<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create([
            'id' => config('constants_permission.ROLES.ID.ADMINISTRADOR'),
            'name' => 'ADMINISTRADOR',
        ]);

        Role::create([
            'id' => config('constants_permission.ROLES.ID.EMPLEADO'),
            'name' => 'EMPLEADO',
        ]);
    }
}
