<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        // User::factory(10)->create();

<<<<<<< HEAD
        User::factory()->create([
            'name' => 'kevin',
            'email' => 'test2@example.com',
            'password' => bcrypt('password'),
=======
        $this->call([
            TipoDocenteSeeder::class,
            EstadoCivilSeeder::class,
            // Agrega aquí otros seeders si los tienes
>>>>>>> origin/elmo
        ]);
    }
}
