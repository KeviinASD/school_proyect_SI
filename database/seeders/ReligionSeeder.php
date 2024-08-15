<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReligionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('RELIGION')->insert([
            ['nombreReligion' => 'Catolico'],
            ['nombreReligion' => 'Protestante'],
            ['nombreReligion' => 'Mormon'],
            ['nombreReligion' => 'Testigo de Jehova'],
            ['nombreReligion' => 'Ateo'],
            ['nombreReligion' => 'Agnostico'],
            ['nombreReligion' => 'Otro'],
            // Agrega más estados civiles si es necesario
        ]);
    }
}
