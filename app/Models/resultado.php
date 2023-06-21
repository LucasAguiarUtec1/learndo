<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class resultado extends Model
{
    use HasFactory;

    protected $fillable = [
        'evaluacion_id',
        'user_id',
        'nota',
    ];

    protected $table = 'resultado';

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
