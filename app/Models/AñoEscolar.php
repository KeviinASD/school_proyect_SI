<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AñoEscolar extends Model
{
    use HasFactory;

    protected $table = 'AÑO_ESCOLAR';

    protected $fillable = [
        'añoEscolar',
    ];

    protected $primaryKey = 'añoEscolar';
    protected $keyType = 'string';
    public $timestamps = false;

    public function fichaMatriculas()
    {
        return $this->hasMany(FichaMatriculas::class, 'añoEscolar', 'añoEscolar');
    }
}
