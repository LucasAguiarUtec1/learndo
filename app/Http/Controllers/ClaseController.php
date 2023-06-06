<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Clase;

class ClaseController extends Controller
{
    public function show()
    {
        $cursos = Clase::where('claseable_type', 'App\Models\Curso')->paginate(5);
        $seminarios = Clase::where('claseable_type', 'App\Models\Seminario')->paginate(5);
        return view('comprar', compact('cursos', 'seminarios'));
    }
}
