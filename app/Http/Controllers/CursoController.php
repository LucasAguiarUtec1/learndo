<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Curso;
use App\Models\Clase;
use Illuminate\Support\Facades\Auth;
use App\Models\Modulo;
use App\Models\Leccion;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Multimedia;
use App\Models\Seminario;

class CursoController extends Controller
{
    public function create(Request $request)
    {
        $curso = new Curso();
        $curso->instructor = $request->instructor;
        $curso->save();
        $free = false;
        if ($request->precio == 0)
            $free = true;

        $curso->clase()->save(new Clase([
            'nombre' => $request->name,
            'descripcion' => $request->descripcion,
            'precio' => $request->precio,
            'free' => $free,
            'organizador_id' => Auth::user()->id,
        ]));

        return redirect()->route('inicio');
    }

    public function misCursos()
    {
        $cursos = Clase::where('organizador_id', Auth::user()->id)->get();
        return view('misCursos', compact('cursos'));
    }

    public function eliminar($id)
    {
        $clase = Clase::find($id);
        $curso = $clase->claseable();
        $clase->delete();
        $curso->delete();
        return redirect()->route('miscursos');
    }

    public function modulos($id)
    {
        $clase = Clase::find($id);
        $curso = $clase->claseable;
        $modulos = $curso->modulos;
        return view('ProfesorModulo', compact('modulos', 'clase'));
    }

    public function crearModulo(Request $request, $id)
    {
        $curso = Clase::find($id)->claseable;
        $modulo = new Modulo();
        $modulo->nombre = $request->name;
        $modulo->descripcion = $request->descripcion;
        $modulo->curso_id = $curso->id;
        $modulo->save();
        return redirect()->route('modulos', $id);
    }

    public function eliminarModulo($id, $idMod)
    {
        $modulo = Modulo::find($idMod);
        $modulo->delete();
        return redirect()->route('modulos', $id);
    }

    public function upload(Request $request)
    {
        $request->validate([
            'pdf_file' => 'required|mimes:pdf',
            'name' => 'required',
        ]);

        $moduloId = $request->input('moduloId');
        $leccion = new Leccion();
        $leccion->nombre = $request->input('name');
        if ($request->hasFile('pdf_file')) {
            $file = $request->file('pdf_file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $path = 'pdfs/' . $fileName;
            Storage::disk('public')->put('pdfs/' . $fileName, \File::get($file));
            $leccion->path = $path;
            $leccion->modulo_id = $moduloId;
            $leccion->nombre_archivo = $fileName;
            $leccion->save();
            return $response = ['message' => 'El archivo se subio correctamente'];
        } else {
            return $response = ['message' => 'Debe Subir un Archivo PDF', 400];
        }
    }

    public function verLeccion(Request $request)
    {
        $leccion = Leccion::where('id', $request->input('leccionId'))->first();
        $url = Storage::disk('public')->url($leccion->path);
        $url = substr($url, 18);
        return response()->json(['response' => [
            'url' => $url,
            'name' => $leccion->nombre_archivo,
        ]]);
    }

    public function eliminarLeccion($idCurso, $idLeccion)
    {
        $leccion = Leccion::find($idLeccion);
        Storage::disk('public')->delete($leccion->path);
        $leccion->delete();
        return redirect()->route('modulos', $idCurso);
    }

    public function agregarMultimedia(Request $request)
    {
        $multimedia = new Multimedia();
        $multimedia->link = $request->input('videoUrl');
        $multimedia->modulo_id = $request->input('moduloId');
        $multimedia->save();
        return $response = ['message' => 'Multimedia agregada correctamente'];
    }

    public function eliminarMultimedia($idCurso, $idMultimedia)
    {
        $multimedia = Multimedia::find($idMultimedia);
        $multimedia->delete();
        return redirect()->route('modulos', $idCurso);
    }

    public function encontrarSeminario(Request $request)
    {
        $latitud = $request->input('latitud');
        $longitud = $request->input('longitud');

        $ubicacion = $latitud . ', ' . $longitud;
        $seminario = Seminario::where('ubicacion', $ubicacion)->first();
        $clase = $seminario->clase()->first();

        return response()->json(['response' => [
            'titulo' => $clase->nombre,
            'descripcion' => $clase->descripcion,
            'precio' => $clase->precio,
            'fecha' => $seminario->fecha,
        ]]);
    }
}
