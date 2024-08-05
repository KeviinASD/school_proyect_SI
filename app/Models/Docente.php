<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Docente extends Model
{
    protected $table = 'DOCENTES';
    protected $primaryKey = 'codigo_docente';

    protected $fillable = [
        'DNI', 'apellidos', 'nombres', 'direccion', 'seguroSocial', 'fechaIngreso', 'id_tipo_docente', 'id_estado_civil'
    ];

    public function tipoDocente()
    {
        return $this->belongsTo(TipoDocente::class, 'id_tipo_docente', 'id_tipo_docente');
    }

    public function estadoCivil()
    {
        return $this->belongsTo(EstadoCivil::class, 'id_estado_civil', 'id_estado_civil');
    }
}
