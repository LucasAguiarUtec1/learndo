<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Leccion extends Model
{
    use HasFactory;

    protected $table = 'lecciones';

    protected $fillable = [
        'nombre',
        'path',
        'modulo_id',
        'nombre_archivo',
        'aceptado',
    ];

    public function modulo()
    {
        return $this->belongsTo('App\Models\Modulo');
    }
}
