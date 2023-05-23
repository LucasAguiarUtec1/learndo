<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Organizador extends Model
{
    use HasFactory;

    protected $table = 'organizadores';

    public function usuario()
    {
        return $this->morphMany(User::class, 'userable');
    }

    public function misClases()
    {
        return $this->hasMany('App\Models\Clase');
    }
}
