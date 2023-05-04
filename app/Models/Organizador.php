<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Organizador extends Model
{
    use HasFactory;

    protected $fillable = [
        'nickname',
        'email',
        'password',
        'nombre',
        'apellido',
        'telefono',
        'bio',
    ];
}
