<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeminarioPresencial extends Model
{
    use HasFactory;

    protected $table = 'seminarios_presenciales';

    protected $fillable = [
        'nombre',
        'descripcion',
        'free',
        'precio',
        'fecha',
        'cupos',
    ];
}
