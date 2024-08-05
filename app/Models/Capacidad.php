<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Capacidad extends Model
{
    protected $table = 'CAPACIDADES';
    protected $primaryKey = ['idCapacidad', 'idAsignatura', 'idCurso'];
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'descripcion',
        'abreviatura',
        'orden',
        'estado',
    ];

    public function asignatura()
    {
        return $this->belongsTo(Asignatura::class, 'idAsignatura', 'idAsignatura')->where('idCurso', $this->idCurso);
    }

    public function curso()
    {
        return $this->belongsTo(Curso::class, 'idCurso');
    }
}
