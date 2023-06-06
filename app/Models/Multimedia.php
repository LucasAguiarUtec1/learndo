<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Multimedia extends Model
{
    use HasFactory;

    protected $table = 'multimedia';

    protected $fillable = [
        'link',
        'modulo_id',
    ];

    public function modulo()
    {
        return $this->belongsTo('App\Models\Modulo');
    }
}
