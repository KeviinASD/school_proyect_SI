<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seccion extends Model
{
    use HasFactory;
    protected $table = 'secciones';
    protected $primaryKey = 'idSeccion';
    protected $fillable = ['idGrado', 'idNivel', 'nombreSeccion'];
    public $timestamps = false;

    public function grado()
    {
        return $this->belongsTo(Grado::class, 'idGrado');
    }
    
    public function nivel()
    {
        return $this->belongsTo(Nivel::class, 'idNivel');
    }
}
