<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class colaboracion extends Model
{
    use HasFactory;

    protected $table = 'colaboracion';

    protected $fillable = [
        'clase_id',
        'usuario_id',
    ];

    public function clase()
    {
        return $this->belongsTo('App\Models\Clase');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
