<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NotaCapacidad extends Model
{
    protected $table = 'NOTA_CAPACIDAD';

    protected $primaryKey = ['idCapacidad', 'codigoAlumno', 'idFicha', 'idAsignatura', 'idCurso', 'codigo_Docente'];

    public $incrementing = false;

    public $timestamps = false;

    protected $fillable = [
        'idCapacidad',
        'codigoAlumno',
        'idFicha',
        'idAsignatura',
        'idCurso',
        'codigo_Docente',
        'nota'
    ];

    public function capacidad()
    {
        return $this->belongsTo(Capacidades::class, 'idCapacidad', 'idCapacidad');
    }
    public function detalleNotas()
    {
        return $this->belongsTo(DetalleNotas::class, 'codigoAlumno', 'codigoAlumno');
    }
}
