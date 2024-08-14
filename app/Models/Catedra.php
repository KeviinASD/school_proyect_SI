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

    // Añadir el campo de estado a los atributos que son asignables en masa
    protected $fillable = ['codigo_docente', 'idSeccion', 'idGrado', 'idNivel', 'idAsignatura', 'idAñoEscolar', 'estado'];

    // Definir el scope para filtrar registros activos
    public function scopeActive($query)
    {
        return $query->where('estado', 1);
    }

    // Si usas timestamps, desactívalos si no se utilizan
    public $timestamps = false;

    // Definir las relaciones
    public function docente()
    {
        return $this->belongsTo(DocenteProvicional::class, 'codigo_docente', 'codigo_docente');
    }

    public function añoEscolar()
    {
        return $this->belongsTo(AñoEscolar::class, 'añoEscolar', 'añoEscolar');
    }

    public function nivel()
    {
        return $this->belongsTo(Nivel::class, 'idNivel');
    }

    public function grado()
    {
        return $this->belongsTo(Grado::class, 'idGrado');
    }

    public function seccion()
    {
        return $this->belongsTo(Seccion::class, 'idSeccion');
    }

    public function asignatura()
    {
        return $this->belongsTo(Asignatura::class, 'idAsignatura');
    }
}
