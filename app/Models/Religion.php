<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Religion extends Model
{
    use HasFactory;

    protected $table = 'religion';
    protected $fillable = [
        'idReligion',
        'nombreReligion',
    ];
    protected $primaryKey = 'idReligion';

    public function alumnos()
    {
        return $this->hasMany(Alumno::class, 'idReligion');
    }
}
