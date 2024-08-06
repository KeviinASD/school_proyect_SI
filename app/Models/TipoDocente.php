<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoDocente extends Model
{
    protected $table = 'TIPO_DOCENTE';
    protected $primaryKey = 'id_tipo_docente';

    public function docentes()
    {
        return $this->hasMany(Docente::class, 'id_tipo_docente', 'id_tipo_docente');
    }
}
