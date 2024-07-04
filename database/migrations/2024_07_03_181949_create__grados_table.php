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
        Schema::create('grados', function (Blueprint $table) {
            $table->increments('idGrado');
            $table->unsignedInteger('idNivel');
            $table->string('nombreGrado', 20);
            $table->timestamps();

            $table->foreign('idNivel')->references('idNivel')->on('niveles');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('grados');
    }
};
