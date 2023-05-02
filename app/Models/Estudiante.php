<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estudiante extends Model
{
    use HasFactory;

    protected $primaryKey = 'nickname';
    protected $keyType = 'string';
    protected $table = 'estudiantes';
    public $incrementing = false;

    protected $fillable = [
        'nickname',
        'creditos'
    ];

    public function usuario()
    {
        return $this->morphOne('App\Models\Usuario', 'tipo_usuario');
    }
}
