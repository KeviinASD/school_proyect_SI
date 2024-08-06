<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Catedra extends Model
{
    use HasFactory;

    protected $table = 'CATEDRAS';
    // Especifica el nombre de la clave primaria
    protected $primaryKey = 'idCatedra'; // Ajusta esto según el nombre real de la columna

    // Si la clave primaria no es un entero autoincrementable
    protected $keyType = 'int'; // o 'string' si es una cadena
    public $incrementing = true; // o false si no es autoincrementable

    protected $fillable = [
        'codigo_docente',
        'idSeccion',
        'idGrado',
        'idNivel',
        'idCurso',
        'idAsignatura',
        'añoEscolar',
    ];

    // Si usas timestamps, desactívalos si no se utilizan
    public $timestamps = false;

    // Definir las relaciones
    public function docente()
    {
        return $this->belongsTo(DocenteProvicional::class, 'codigo_docente', 'codigo_docente');
    }

    public function seccion()
    {
        return $this->belongsTo(Seccion::class, 'idSeccion', 'idSeccion');
    }

    public function grado()
    {
        return $this->belongsTo(Grado::class, 'idGrado', 'idGrado');
    }

    public function nivel()
    {
        return $this->belongsTo(Nivel::class, 'idNivel', 'idNivel');
    }

    public function curso()
    {
        return $this->belongsTo(Curso::class, 'idCurso', 'idCurso');
    }

    public function asignatura()
    {
        return $this->belongsTo(Asignatura::class, 'idAsignatura', 'idAsignatura');
    }

    public function añoEscolar()
    {
        return $this->belongsTo(AñoEscolar::class, 'añoEscolar', 'añoEscolar');
    }
}
