<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AñoEscolar extends Model
{
    use HasFactory;

    // Nombre de la tabla en la base de datos
    protected $table = 'AÑO_ESCOLAR';

    // Campo de la clave primaria
    protected $primaryKey = 'añoEscolar';

    // Tipo de la clave primaria
    protected $keyType = 'string'; // Asegúrate de que esto coincide con el tipo de dato en la base de datos

    // Campos que se pueden asignar masivamente
    protected $fillable = [
        'añoEscolar',
        'estado'
    ];

    // Desactiva los timestamps si no se usan
    public $timestamps = false;

    public function fichaMatriculas()
    {
        return $this->hasMany(FichaMatriculas::class, 'añoEscolar', 'añoEscolar');
    }
}
