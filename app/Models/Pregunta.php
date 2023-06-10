<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pregunta extends Model
{
    use HasFactory;

    protected $fillable = [
        'pregunta',
        'respuesta1',
        'correct1',
        'respuesta2',
        'correct2',
        'respuesta3',
        'correct3',
        'respuesta4',
        'correct4',
    ];

    public function evaluacion()
    {
        return $this->belongsTo('App\Models\Evaluacion');
    }
}
