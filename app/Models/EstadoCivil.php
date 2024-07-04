<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstadoCivil extends Model
{
    use HasFactory;

    protected $table = 'estado_civil';
    protected $fillable = [
        'idEstadoCivil',
        'nombreEstadoCivil',
    ];
    protected $primaryKey = 'idEstadoCivil';

    public function alumnos()
    {
        return $this->hasMany(Alumno::class, 'idEstadoCivil');
    }
}
