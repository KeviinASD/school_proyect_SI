<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AñoEscolarActual extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'año_escolar_actual';

    protected $fillable = ['año_escolar_id'];

    public function añoEscolar()
    {
        return $this->belongsTo(AñoEscolar::class, 'añoEscolar');
    }
}