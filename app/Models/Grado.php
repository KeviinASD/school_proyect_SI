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
        return $this->hasOne(Nivel::class, 'idNivel', 'idNivel');
    }

    public function secciones()
    {
        return $this->hasMany(Seccion::class, 'idGrado', 'idGrado');
    }

    public function fichaMatriculas()
    {
        return $this->hasMany(FichaMatriculas::class, 'idGrado', 'idGrado');
    }
}
