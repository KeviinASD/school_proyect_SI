<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grado extends Model
{
    use HasFactory;

    protected $table = 'grados';
    protected $primaryKey = 'idGrado';
    protected $keyType = 'int';
    protected $fillable = [
        'idGrado',
        'idNivel',
        'nombreGrado',
        'estado'
    ];

    public $timestamps = false;

    public function nivel()
    {
        return $this->belongsTo(Nivel::class, 'idNivel', 'idNivel');
    }

    public function secciones()
    {
        return $this->hasMany(Seccion::class, 'idGrado', 'idGrado')->where('estado', 1);
    }

    public function asignaturas()
    {
        return $this->hasMany(Asignatura::class, 'idGrado', 'idGrado')->where('estado', 1);
    }
}
