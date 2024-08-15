<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AñoIngreseeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('AÑO_ESCOLAR')->insert([
            ['añoEscolar' => '2024'],
            ['añoEscolar' => '2023'],
            ['añoEscolar' => '2022'],
            ['añoEscolar' => '2021'],
            ['añoEscolar' => '2020'],
            ['añoEscolar' => '2019'],
            // Agrega más tipos de docentes si es necesario
        ]);
    
    }
}
