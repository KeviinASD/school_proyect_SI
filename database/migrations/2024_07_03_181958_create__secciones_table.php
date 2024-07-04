<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('secciones', function (Blueprint $table) {
            $table->increments('idSeccion');
            $table->unsignedInteger('idGrado');
            $table->unsignedInteger('idNivel');
            $table->string('nombreSeccion', 4);
            $table->timestamps();

            $table->foreign('idGrado')->references('idGrado')->on('grados');
            $table->foreign('idNivel')->references('idNivel')->on('grados');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('secciones');
    }
};
