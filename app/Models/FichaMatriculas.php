<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FichaMatriculas extends Model
{
    public $timestamps = false;
    protected $table = 'Ficha_Matriculas';
    protected $primaryKey = 'nroMatricula';

    protected $fillable = [
        'nroMatricula', 'codigoAlumno', 'fechaMatricula', 'idSeccion', 'idGrado', 'idNivel', 'añoEscolar'
    ];

    public function alumno()
    {
        return $this->belongsTo(Alumno::class, 'codigoAlumno', 'codigoAlumno');
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

    public function anioEscolar()
    {
        return $this->belongsTo(AnioEscolar::class, 'añoEscolar', 'anioEscolar');
    }
}
