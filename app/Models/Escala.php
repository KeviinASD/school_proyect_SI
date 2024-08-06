<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Escala extends Model
{
    use HasFactory;

    protected $table = 'escala';
    protected $fillable = [
        'idEscala',
        'nombreEscala',
    ];
    protected $primaryKey = 'idEscala';

    public function alumnos()
    {
        return $this->hasMany(Alumno::class, 'idEscala');
    }
}
