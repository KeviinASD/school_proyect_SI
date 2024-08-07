<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EstadoCivil extends Model
{
    public $timestamps = false;
    protected $table = 'ESTADO_CIVIL';
    protected $primaryKey = 'idEstadoCivil';

    public function docentes()
    {
        return $this->hasMany(Docente::class, 'idEstadoCivil', 'idEstadoCivil');
    }
}
