<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Asignatura extends Model
{
    protected $table = 'ASIGNATURAS';
    protected $primaryKey = ['idAsignatura', 'idCurso'];
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'idCurso',
        'idGrado',
        'idNivel',
        'estado',
    ];

    public function curso()
    {
        return $this->belongsTo(Curso::class, 'idCurso');
    }

    public function grado()
    {
        return $this->belongsTo(Grado::class, 'idGrado');
    }

    public function nivel()
    {
        return $this->belongsTo(Nivel::class, 'idNivel');
    }

    public function capacidades()
    {
        return $this->hasMany(Capacidad::class, 'idAsignatura', 'idAsignatura')->where('idCurso', $this->idCurso);
    }
}
