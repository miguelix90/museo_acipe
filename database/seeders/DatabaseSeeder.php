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
            'name' => 'Miguel A. Huete',
            'email' => 'mahuete@acipe.es',
            'password' => bcrypt('password'), // Cambiar esta contraseña después
            'role' => 'superadmin',
        ]);

        // Crear un usuario admin de ejemplo
        User::create([
            'name' => 'Juan Fernandez',
            'email' => 'jfernandez@psi.ucm.es',
            'password' => bcrypt('password'), // Cambiar esta contraseña después
            'role' => 'superadmin',
        ]);

        // Crear un usuario admin de ejemplo
        User::create([
            'name' => 'Admin',
            'email' => 'admin2@museo.acipe.es',
            'password' => bcrypt('ajjsnew213141#'), // Cambiar esta contraseña después
            'role' => 'admin',
        ]);
    }
}
