<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleNotas extends Model
{
    use HasFactory;

    protected $table = 'detalle_notas';

    // Como tenemos una clave primaria compuesta
    protected $primaryKey = ['codigoAlumno', 'idFicha', 'idAsignatura', 'codigo_Docente'];
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'codigoAlumno', 'idFicha', 'idAsignatura', 'codigo_Docente'
    ];

    public function notasCapacidad()
    {
        return $this->hasMany(NotaCapacidad::class, 'codigoAlumno', 'codigoAlumno')
            ->where('idFicha', $this->idFicha)
            ->where('idAsignatura', $this->idAsignatura)
            ->where('codigo_Docente', $this->codigo_Docente);
    }

    public function alumno()
    {
        return $this->belongsTo(Alumno::class, 'codigoAlumno', 'codigoAlumno');
    }
}