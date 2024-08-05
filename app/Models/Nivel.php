<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nivel extends Model
{
    use HasFactory;
    protected $table = 'niveles';
    protected $primaryKey = 'idNivel';
    protected $fillable = ['nombreNivel', 'estado'];
    public $timestamps = false;

    public function grados()
    {
        return $this->hasMany(Grado::class, 'idNivel', 'idNivel');
    }
}
