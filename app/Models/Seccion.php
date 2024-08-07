<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seccion extends Model
{
    use HasFactory;
    protected $table = 'secciones';
    protected $primaryKey = 'idSeccion';
    protected $fillable = [
        'idSeccion',
        'idGrado',
        'idNivel',
        'nombreSeccion',
        'estado'
    ];
    public $timestamps = false;

    public function grado()
    {
        return $this->hasOne(Grado::class, 'idGrado', 'idGrado');
    }

    public function nivel()
    {
        return $this->hasOne(Nivel::class, 'idNivel', 'idNivel');
    }
}
