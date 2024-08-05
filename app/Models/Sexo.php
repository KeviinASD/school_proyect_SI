<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sexo extends Model
{
    use HasFactory;

    protected $table = 'sexo';
    protected $fillable = [
        'idSexo',
        'nombreSexo',
    ];

    protected $primaryKey = 'idSexo';

    public function alumnos()
    {
        return $this->hasMany(Alumno::class, 'idSexo');
    }

    
}
