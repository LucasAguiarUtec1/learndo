<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clase extends Model
{
    use HasFactory;

    protected $table = 'clases';


    protected $fillable = [
        'nombre',
        'descripcion',
        'precio',
        'free',
        'organizador_id',
    ];

    public function claseable()
    {
        return $this->morphTo();
    }

    public function Organizador()
    {
        return $this->belongsTo('App\Models\Organizador');
    }
}
