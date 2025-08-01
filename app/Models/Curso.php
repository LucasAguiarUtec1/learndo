<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    use HasFactory;

    protected $fillable = [
        'instructor',
    ];

    public function clase()
    {
        return $this->morphMany(Clase::class, 'claseable');
    }

    public function modulos()
    {
        return $this->hasMany('App\Models\Modulo');
    }

    public function usuarios()
    {
        return $this->belongsToMany('App\Models\User');
    }
}
