<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Usuario extends Model
{
    use HasFactory;

    use Notifiable;

    protected $fillable = [
        'nickname',
        'email',
        'password',
        'nombre',
        'apellido',
        'telefono',
        'biografia',
    ];

    protected $guarded = [];

    protected $hidden = [
        'password',
    ];

    public function userable()
    {
        return $this->morphTo();
    }

    protected function nickname(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => ucwords($value),
            set: fn (string $value) => strtolower($value),
        );
    }

    protected function biografia(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => ucwords($value),
            set: fn (string $value) => htmlspecialchars($value),
        );
    }
}
