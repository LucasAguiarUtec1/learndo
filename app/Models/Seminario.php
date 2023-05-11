<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seminario extends Model
{
    use HasFactory;

    protected $fillable = [
        'fecha',
    ];

    public function clase()
    {
        return $this->morphMany(Clase::class, 'claseable');
    }
}
