<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    use HasFactory;

    protected $primaryKey = 'idCurso';

    protected $fillable = [
        'nombreCurso',
        'idNivel',
    ];
    public $timestamps = false;

    public function nivel()
    {
        return $this->belongsTo(Nivel::class, 'idNivel');
    }

    
}
