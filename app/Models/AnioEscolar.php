<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnioEscolar extends Model
{
    use HasFactory;

    // Nombre de la tabla en la base de datos
    protected $table = 'AÑO_ESCOLAR';

    // Campos que se pueden asignar masivamente
    protected $fillable = [
        'anioEscolar',
    ];

    // Llave primaria
    protected $primaryKey = 'anioEscolar';

    // Tipo de llave primaria
    protected $keyType = 'string';

    // Evitar el uso de timestamps en esta tabla
    public $timestamps = false;
}
