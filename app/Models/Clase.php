<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clase extends Model
{
    use HasFactory;

    protected $primaryKey = 'nombre';

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = [
        'nombre',
        'descripcion',
        'precio',
        'free',
    ];

    public function claseable()
    {
        return $this->morphTo();
    }
}
