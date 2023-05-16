<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SeminarioController extends Controller
{
    public function create(Request $request)
    {
        if ($request->tipo == "Presencial") {
            return $request->ubicacion;
        }
    }
}
