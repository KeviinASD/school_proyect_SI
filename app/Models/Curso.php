<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    use HasFactory;

    protected $table = 'cursos';

    protected $fillable = [
        'nombreCurso',
        'idNivel',
    ];

    public function nivel()
    {
        return $this->belongsTo(Nivel::class, 'idNivel');
    }
}
