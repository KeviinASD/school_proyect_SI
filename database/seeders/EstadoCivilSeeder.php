<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EstadoCivilSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('ESTADO_CIVIL')->insert([
            ['nombreEstadoCivil' => 'Soltero/a'],
            ['nombreEstadoCivil' => 'Casado/a'],
            ['nombreEstadoCivil' => 'Divorciado/a'],
            ['nombreEstadoCivil' => 'Viudo/a'],
            // Agrega más estados civiles si es necesario
        ]);
    }
}
