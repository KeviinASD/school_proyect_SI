<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grado extends Model
{
    use HasFactory;
    protected $table = 'grados';
    protected $primaryKey = 'idGrado';
    protected $fillable = ['idNivel', 'nombreGrado'];
    public $timestamps = false;

    public function nivel()
    {
        return $this->hasOne(Nivel::class, 'idNivel', 'idNivel');
    }

    public function secciones()
    {
        return $this->hasMany(Seccion::class, 'idGrado');
    }
}
