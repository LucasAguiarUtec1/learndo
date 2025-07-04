<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Modulo extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'descripcion',
        'aceptado',
    ];

    public function curso()
    {
        return $this->belongsTo('App\Models\Curso');
    }

    public function lecciones()
    {
        return $this->hasMany('App\Models\Leccion');
    }

    public function multimedia()
    {
        return $this->hasMany('App\Models\Multimedia');
    }
}
