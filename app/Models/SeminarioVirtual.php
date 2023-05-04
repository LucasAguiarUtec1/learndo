<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeminarioVirtual extends Model
{
    use HasFactory;

    protected $table = 'seminarios_virtuales';

    protected $fillable = [
        'nombre',
        'descripcion',
        'free',
        'precio',
        'fecha',
        'plataforma'
    ];
}
