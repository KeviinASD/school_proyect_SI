<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AñoEscolar extends Model
{
    use HasFactory;
    protected $table = 'AÑO_ESCOLAR';
    protected $primaryKey = 'añoEscolar';
    protected $fillable = [
        'añoEscolar',
        'estado'
    ];
}
