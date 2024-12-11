<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EscalaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('ESCALA')->insert([
            ['nombreEscala' => 'A'],
            ['nombreEscala' => 'B'],
            ['nombreEscala' => 'C'],
            ['nombreEscala' => 'D'],
            ['nombreEscala' => 'E'],
            // Agrega más tipos de docentes si es necesario
        ]);
    }
}
