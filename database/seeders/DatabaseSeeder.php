<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $this->call(UsersTableSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(UsuariosRolesSeeder::class);
        $this->call(PermisosSeeder::class);
        $this->call(PermisosRolesSeeder::class);
    }
}
