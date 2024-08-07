<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class FichaNotas extends Model
{
    use HasFactory;
    protected $table = 'FICHA_NOTAS';
    protected $primaryKey = 'idFicha';
    protected $fillable = [
        'idFicha',
        'idAsignatura',
        'idCurso',
        'codigo_Docente',
        'fecha',
        'idSeccion',
        'idGrado',
        'idNivel',
        'añoEscolar',
        'periodo',
        'estado'
    ];

    public $timestamps = false;

    public function seccion()
    {
        return $this->hasOne(Seccion::class, 'idSeccion', 'idSeccion');
    }
    
    public function grado()
    {
        return $this->hasOne(Grado::class, 'idGrado', 'idGrado');
    }

    public function nivel()
    {
        return $this->hasOne(Nivel::class, 'idNivel', 'idNivel');
    }

    public function añoEscolar()
    {
        return $this->hasOne(AñoEscolar::class, 'añoEscolar', 'añoEscolar');
    }

    public function docente(){
        return $this->hasOne(DocenteProvicional::class, 'codigo_docente', 'codigo_Docente');
    }

    public function detalle_notas(){

    }

    public function asignatura(){
        return $this->belongsTo(Asignatura::class, 'idAsignatura');
    }

}
