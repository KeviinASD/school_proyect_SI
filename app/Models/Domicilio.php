<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Domicilio extends Model
{
    use HasFactory;

    protected $table = 'domicilio';
    protected $fillable = [
        'idDomicilio',
        'direccion',
        'telefono',
        'departamento',
        'provincia',
        'distrito',
    ];
    protected $primaryKey = 'idDomicilio';

    public function alumno()
    {
        return $this->hasOne(Alumno::class, 'idDomicilio');
    }
}
