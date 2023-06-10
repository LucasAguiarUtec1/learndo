<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evaluacion extends Model
{
    use HasFactory;

    protected $table = 'evaluaciones';

    protected $fillable = [
        'nombre',
    ];

    public function modulo()
    {
        return $this->belongsTo('App\Models\Modulo');
    }

    public function preguntas()
    {
        return $this->hasMany('App\Models\Pregunta');
    }
}
