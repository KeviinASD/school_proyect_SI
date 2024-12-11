<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoDocenteProvicional extends Model
{
    use HasFactory;
    protected $table = 'tipo_docente';
    protected $primaryKey = 'id_tipo_docente';
    public $timestamps = false;
    protected $fillable = [
        'id_tipo_docente',
        'nombreTipo',
        'estado'
    ];
}
