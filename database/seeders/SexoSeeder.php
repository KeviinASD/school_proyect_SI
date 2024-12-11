<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SexoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('SEXO')->insert([
            ['nombreSexo' => 'Masculino'],
            ['nombreSexo' => 'Femenino'],
            ['nombreSexo' => 'Otro'],
            
        ]);
    }
}
