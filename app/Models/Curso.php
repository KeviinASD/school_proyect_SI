<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    use HasFactory;

    protected $table = 'cursos';
    protected $primaryKey = 'idCurso';
    protected $fillable = ['nombreCurso', 'estado'];
    public $timestamps = false;

    public function asignaturas()
    {
        return $this->hasMany(Asignatura::class, 'idCurso', 'idCurso');
    }
}
