<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alumno extends Model
{
    use HasFactory;

    public $timestamps = false;
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

    public function sexo()
    {
        return $this->belongsTo(Sexo::class, 'idSexo');
    }
    public function domicilio()
    {
        return $this->belongsTo(Domicilio::class, 'idDomicilio');
    }
    public function estadoCivil()
    {
        return $this->belongsTo(EstadoCivil::class, 'idEstadoCivil');
    }
    public function religion()
    {
        return $this->belongsTo(Religion::class, 'idReligion');
    }
    public function escala()
    {
        return $this->belongsTo(Escala::class, 'idEscala');
    }
}
