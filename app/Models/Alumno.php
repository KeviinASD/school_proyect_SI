<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alumno extends Model
{
    protected $table = 'alumnos';

    protected $fillable = [
        'codigoAlumno',
        'nombres',
        'apellidos',
        'DNI',
        'fechaNacimiento',
        'añoIngreso',
        'departamento',
        'pais',
        'provincia',
        'distrito',
        'lenguaMaterna',
        'fechaBautizo',
        'parroquiaDeBautizo',
        'colegioProcedencia',
        'idDomicilio',
        'idEstadoCivil',
        'idReligion',
        'idEscala',
        'idSexo',
    ];
}
