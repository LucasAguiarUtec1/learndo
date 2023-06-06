<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Clase;

class ClaseController extends Controller
{
    public function show()
    {
        $clases = Clase::paginate(5);
        return view('comprar', compact('clases'));
    }
}
