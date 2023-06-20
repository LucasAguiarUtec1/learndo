<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recomendacion extends Model
{
    use HasFactory;

    protected $table = 'recomendaciones';


    protected $fillable = [
        'emisor_id',
        'receptor_id',
        'curso_id',
        'estado',
    ];

    public function emisor()
    {
        return $this->belongsTo('App\Models\User', 'emisor_id');
    }

    public function receptor()
    {
        return $this->belongsTo('App\Models\User', 'receptor_id');
    }
}
