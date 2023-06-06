<?php

namespace App\Http\Controllers;

use App\Http\Requests\SeminarioRequest;
use App\Models\Seminario;
use Illuminate\Http\Request;
use App\Models\Clase;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class SeminarioController extends Controller
{

    public function create(Request $request)
    {
        $request->validate([
            'image' => 'nullable|image',
            'fecha' => 'required|date',
            'tipo' => 'required|in:Presencial,Online',
            'ubi' => 'required_if:tipo,Presencial',
            'plataforma' => 'required_if:tipo,Online',
            'name' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'precio' => 'required|numeric',
            'free' => 'boolean',
        ]);


        $path = null;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $path = 'images/' . $fileName;
            $file->move(public_path('images'), $fileName);
        }

        if ($request['tipo'] == "Presencial") {
            $seminario = new Seminario();
            $seminario->fecha = $request['fecha'];
            $seminario->ubicacion = $request['ubi'];
            $seminario->tipo = $request['tipo'];
            $seminario->save();
            $free = $request['free'] == 0 ? true : false;

            $clase = new Clase();
            $clase->nombre = $request['name'];
            $clase->descripcion = $request['descripcion'];
            $clase->precio = $request['precio'];
            $clase->free = $free;
            $clase->organizador_id = Auth::user()->id;
            $clase->foto = $path;
            $seminario->clase()->save($clase);
        } else {
            $seminario = new Seminario();
            $seminario->fecha = $request['fecha'];
            $seminario->plataforma = $request['plataforma'];
            $seminario->tipo = $request['tipo'];
            $seminario->save();
            $free = $request['free'] == 0 ? true : false;

            $clase = new Clase();
            $clase->nombre = $request['name'];
            $clase->descripcion = $request['descripcion'];
            $clase->precio = $request['precio'];
            $clase->free = $free;
            $clase->organizador_id = Auth::user()->id;
            $clase->foto = $path;
            $seminario->clase()->save($clase);
        }

        return redirect()->route('inicio');
    }

    public function delete($id)
    {
        $clase = Clase::find($id);
        $seminario = $clase->claseable;
        if (File::exists($clase->foto))
            File::delete($clase->foto);
        $clase->delete();
        $seminario->delete();
        return redirect()->route('miscursos');
    }

    public function getUbicaciones()
    {
        $ubicaciones = Seminario::where('ubicacion', '!=', null)->get();

        return view('mapita', ['ubicaciones' => $ubicaciones]);
    }

    public function verSeminario($id)
    {
        $clase = Clase::where('nombre', $id)->first();
        $url = Storage::disk('public')->url($clase->foto);
        $url = substr($url, 18);
        return view('seminario', compact('clase', 'url'));
    }
}
