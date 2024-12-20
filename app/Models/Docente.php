<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Docente extends Model
{
    public $timestamps = false;
    protected $table = 'DOCENTES';
    protected $primaryKey = 'codigo_docente';
    public $incrementing = false;

    protected $fillable = [
        'codigo_docente', 'DNI', 'apellidos', 'nombres', 'direccion', 'seguroSocial', 'fechaIngreso', 'id_tipo_docente', 'idEstadoCivil', 'imagen_url', 'estado'
    ];

    public function tipoDocente()
    {
        return $this->belongsTo(TipoDocente::class, 'id_tipo_docente', 'id_tipo_docente');
    }

    public function estadoCivil()
    {
        return $this->belongsTo(EstadoCivil::class, 'idEstadoCivil', 'idEstadoCivil');
    }

    public function catedras()
    {
        return $this->hasMany(Catedra::class, 'codigo_docente');
    }
}
