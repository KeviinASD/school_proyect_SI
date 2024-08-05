<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Catedra extends Model
{
    use HasFactory;

    // Define el nombre de la tabla asociada
    protected $table = 'CATEDRAS';

    // Define las claves primarias compuestas
    protected $primaryKey = ['idCatedra', 'codigo_docente'];

    // Indica que la clave primaria es compuesta
    public $incrementing = false;

    // Define el tipo de clave primaria
    protected $keyType = 'int';

    // Define qué campos pueden ser asignados masivamente
    protected $fillable = [
        'idCatedra',
        'codigo_docente',
        'idSeccion',
        'idGrado',
        'idNivel',
        'idAsignatura',
        'idCurso',
        'añoEscolar',
    ];

    // Define las relaciones con otros modelos

    /**
     * Relación con el modelo Docente.
     */
    public function docente()
    {
        return $this->belongsTo(Docente::class, 'codigo_docente', 'codigo_docente');
    }

    /**
     * Relación con el modelo Seccion.
     */
    public function seccion()
    {
        return $this->belongsTo(Seccion::class, ['idSeccion', 'idGrado', 'idNivel'], ['idSeccion', 'idGrado', 'idNivel']);
    }

    /**
     * Relación con el modelo Asignatura.
     */
    public function asignatura()
    {
        return $this->belongsTo(Asignatura::class, ['idAsignatura', 'idCurso'], ['idAsignatura', 'idCurso']);
    }

    /**
     * Relación con el modelo AnioEscolar.
     */
    public function anioEscolar()
    {
        return $this->belongsTo(AnioEscolar::class, 'añoEscolar', 'añoEscolar');
    }
}
