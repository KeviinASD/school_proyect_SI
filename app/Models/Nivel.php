<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nivel extends Model
{
    use HasFactory;
    protected $table = 'niveles';
    protected $primaryKey = 'idNivel';
    protected $fillable = ['nombreNivel', 'estado'];
    public $timestamps = false;

    public function grados()
    {
        return $this->hasMany(Grado::class, 'idNivel', 'idNivel')->where('estado', 1);

    }
    public function cursos()
    {
        return $this->hasMany(Curso::class, 'idNivel', 'idNivel')->where('estado', 1);
    }

    public function secciones()
    {
        return $this->hasMany(Seccion::class, 'idNivel', 'idNivel');
    }
}
