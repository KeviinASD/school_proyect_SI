<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Capacidad extends Model
{
    protected $table = 'CAPACIDADES';
    protected $primaryKey = 'idCapacidad'; // Ajusta según tu esquema si no usas una clave primaria compuesta
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'descripcion',
        'abreviatura',
        'orden',
        'idAsignatura'
    ];

    public function asignatura()
    {
        return $this->belongsTo(Asignatura::class, 'idAsignatura', 'idAsignatura');
    }


    public function notasCapacidad()
    {
        return $this->hasMany(NotaCapacidad::class, 'idCapacidad', 'idCapacidad');
    }
}
