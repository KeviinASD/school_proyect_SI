<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EstadoCivil extends Model
{
    protected $table = 'ESTADO_CIVIL';
    protected $primaryKey = 'id_estado_civil';

    public function docentes()
    {
        return $this->hasMany(Docente::class, 'id_estado_civil', 'id_estado_civil');
    }
}
