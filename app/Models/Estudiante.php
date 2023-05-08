<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estudiante extends Model
{
    use HasFactory;

    protected $fillable = [
        'creditos',
    ];

    public function usuario()
    {
        return $this->morphMany(Usuario::class, 'userable');
    }
}
