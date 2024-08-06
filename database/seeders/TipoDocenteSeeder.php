<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TipoDocenteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('TIPO_DOCENTE')->insert([
            ['nombreTipo' => 'Tiempo Completo'],
            ['nombreTipo' => 'Tiempo Parcial'],
            ['nombreTipo' => 'Contratado'],
            // Agrega más tipos de docentes si es necesario
        ]);
    }
}
