<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    use HasFactory;

    protected $fillable = [
        'nickname',
        'email',
        'telefono',
        'nombre',
        'biografia',
        'password',
        'tipo_usuario'
    ];

    public function tipo_usuario()
    {
        return $this->morphTo();
    }
}
