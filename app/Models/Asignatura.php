<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asignatura extends Model
{
    use HasFactory;

    protected $table = 'asignaturas';
    protected $primaryKey = 'idAsignatura'; // Define la clave primaria
    public $timestamps = false; // Desactiva los timestamps automáticos
    // En App\Models\Asignatura.php
    protected $fillable = ['idCurso', 'idGrado', 'idNivel', 'nombreAsignatura', 'estado'];


    // Definir las relaciones
    public function curso()
    {
        return $this->belongsTo(Curso::class, 'idCurso', 'idCurso');
    }

    public function grado()
    {
        return $this->belongsTo(Grado::class, 'idGrado', 'idGrado');
    }

    public function nivel()
    {
        return $this->belongsTo(Nivel::class, 'idNivel', 'idNivel');
    }
}
