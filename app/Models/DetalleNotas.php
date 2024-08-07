<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleNotas extends Model
{
    use HasFactory;

    protected $table = 'detalle_notas';

    // Como tenemos una clave primaria compuesta
    protected $primaryKey = ['codigoAlumno', 'idFicha', 'idAsignatura', 'idCurso', 'codigo_Docente'];
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'codigoAlumno', 'idFicha', 'idAsignatura', 'idCurso', 'codigo_Docente'
    ];

    public function notasCapacidad()
    {
        return $this->hasMany(NotaCapacidad::class, [
            'codigoAlumno', 
            'idFicha', 
            'idAsignatura', 
            'idCurso', 
            'codigo_Docente'
        ], [
            'codigoAlumno', 
            'idFicha', 
            'idAsignatura', 
            'idCurso', 
            'codigo_Docente'
        ]);
    }
}