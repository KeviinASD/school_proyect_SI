<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\AñoEscolarActual;

class CreateAñoEscolarActualTable extends Migration
{
    public function up()
    {
        // Crear la tabla
        Schema::create('año_escolar_actual', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('año_escolar_id');
            $table->foreign('año_escolar_id')->references('añoEscolar')->on('año_escolar')->onDelete('cascade');
            
        });

        AñoEscolarActual::create([
            'año_escolar_id' => '2024',
        ]);
    }

    public function down()
    {
        Schema::dropIfExists('año_escolar_actual');
    }
}
