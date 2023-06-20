<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class invitacion extends Model
{
    use HasFactory;

    protected $table = 'invitacion';

    protected $fillable = [
        'clase_id',
        'usuario_id',
        'token',
    ];
}
