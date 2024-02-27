<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     */
    public function run(): void
    {
        User::create([
            'username' => 'administrador',
            'nombre' => 'Administrador',
            'apellidos' => 'Company',
            'email' => 'jose.ortega@company.es',
            'password' => bcrypt('administrador'),
            'activo' => 1,
            'fecha_nacimiento' => '2000-01-01'
        ]);

        User::create([
            'username' => 'empleado',
            'nombre' => 'Empleado',
            'apellidos' => '',
            'email' => 'empleado@company.es',
            'password' => bcrypt('empleado'),
            'activo' => 1,
        ]);

        User::create([
            'username' => 'empleadovip',
            'nombre' => 'Empleado VIP',
            'apellidos' => '',
            'email' => 'empleadovip@company.es',
            'password' => bcrypt('empleadovip'),
            'activo' => 1,
        ]);

        User::factory(10)->create();
        User::factory(10)->unverified()->create();
    }
}
