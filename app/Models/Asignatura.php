<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asignatura extends Model
{
    use HasFactory;

    protected $table = 'asignaturas';
    protected $primaryKey = 'idAsignatura';
    public $timestamps = false;
    protected $fillable = ['idGrado', 'idNivel', 'nombreAsignatura', 'estado'];

    public function grado()
    {
        return $this->belongsTo(Grado::class, 'idGrado', 'idGrado');
    }

    public function nivel()
    {
        return $this->belongsTo(Nivel::class, 'idNivel', 'idNivel');
    }
    public function capacidades()
    {
        return $this->hasMany(Capacidad::class, 'idAsignatura');
    }
}
