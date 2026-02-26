<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Crear usuario superadministrador inicial
        User::create([
            'name' => 'Superadmin',
            'email' => 'admin@museo.acipe.es',
            'password' => bcrypt('password'), // Cambiar esta contraseña después
            'role' => 'superadmin',
        ]);

        // Crear un usuario admin de ejemplo
        User::create([
            'name' => 'Administrador',
            'email' => 'admin2@museo.acipe.es',
            'password' => bcrypt('password'), // Cambiar esta contraseña después
            'role' => 'admin',
        ]);
    }
}
