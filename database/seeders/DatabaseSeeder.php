<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        // Crea un usuario de ejemplo
        User::factory()->create([
            'name' => 'kevin',
            'email' => 'test2@example.com',
            'password' => bcrypt('password'),
        ]);

        // Llama a otros seeders
        $this->call([
            TipoDocenteSeeder::class,
            EstadoCivilSeeder::class,
            // Agrega aquí otros seeders si los tienes
        ]);
    }
}
