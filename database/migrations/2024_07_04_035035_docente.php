<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Crear tabla TIPO_DOCENTE
        Schema::create('TIPO_DOCENTE', function (Blueprint $table) {
            $table->id('id_tipo_docente');
            $table->string('nombreTipo'); // Ejemplo de columna
            $table->timestamps(); // Crea columnas 'created_at' y 'updated_at'
        });

        // Crear tabla ESTADO_CIVIL
        Schema::create('ESTADO_CIVIL', function (Blueprint $table) {
            $table->id('id_estado_civil');
            $table->string('nombreEstadoCivil'); // Ejemplo de columna
            $table->timestamps(); // Crea columnas 'created_at' y 'updated_at'
        });

        // Crear tabla DOCENTES con llaves foráneas a TIPO_DOCENTE y ESTADO_CIVIL
        Schema::create('DOCENTES', function (Blueprint $table) {
            $table->id('codigo_docente');
            $table->string('DNI')->unique();
            $table->string('apellidos');
            $table->string('nombres');
            $table->string('direccion');
            $table->string('seguroSocial')->nullable();
            $table->date('fechaIngreso');
            $table->unsignedBigInteger('id_tipo_docente'); // Llave foránea a TIPO_DOCENTE
            $table->unsignedBigInteger('id_estado_civil'); // Llave foránea a ESTADO_CIVIL
            $table->timestamps(); // Crea columnas 'created_at' y 'updated_at'

            // Definir llaves foráneas dentro del mismo bloque
            $table->foreign('id_tipo_docente')
                  ->references('id_tipo_docente')
                  ->on('TIPO_DOCENTE')
                  ->onDelete('cascade'); // En caso de eliminar un tipo_docente, eliminar todos los docentes relacionados

            $table->foreign('id_estado_civil')
                  ->references('id_estado_civil')
                  ->on('ESTADO_CIVIL')
                  ->onDelete('cascade'); // En caso de eliminar un estado_civil, eliminar todos los docentes relacionados
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Eliminar las tablas en orden inverso para evitar conflictos de llave foránea
        Schema::dropIfExists('DOCENTES');
        Schema::dropIfExists('ESTADO_CIVIL');
        Schema::dropIfExists('TIPO_DOCENTE');
    }
};
