<?php

// app/Models/NotaCapacidad.php
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

    // Relación con el modelo Capacidad
    public function capacidad()
    {
        return $this->belongsTo(Capacidad::class, 'idCapacidad', 'idCapacidad');
    }

    // Relación con el modelo DetalleNotas
    public function detalleNotas()
    {
        return $this->belongsTo(DetalleNotas::class, 'codigoAlumno', 'codigoAlumno');
    }
}

