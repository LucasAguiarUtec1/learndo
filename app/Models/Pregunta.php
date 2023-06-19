<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pregunta extends Model
{
    use HasFactory;

    protected $fillable = [
        'pregunta',
    ];

    public function evaluacion()
    {
        return $this->belongsTo('App\Models\Evaluacion');
    }

    public function preguntas()
    {
        return $this->hasMany('App\Models\Respuesta');
    }
}
