<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocenteProvicional extends Model
{
    use HasFactory;
    protected $table = 'docentes';
    protected $primaryKey = 'codigo_docente';
    protected $keyType = 'string';
    public $timestamps = false;
    protected $fillable = [
        'codigo_docente',
        'DNI',
        'apellidos',
        'nombres',
        'direccion',
        'seguroSocial',
        'fechaIngreso',
        'id_tipo_docente',
        'idEstadoCivil',
        'estado'
    ];

    public function tipoDocente()
    {
        return $this->hasOne(TipoDocenteProvicional::class, 'id_tipo_docente', 'id_tipo_docente');
    }

    public function estadoCivil()
    {
        return $this->hasOne(EstadoCivil::class, 'idEstadoCivil', 'idEstadoCivil');
    }
    public function scopeFindByCodigo($query, $codigo)
    {
        return $query->where('codigo_docente', $codigo)->first();
    }

    public function catedras()
    {
        return $this->hasMany(Catedra::class, 'codigo_docente');
    }
}
