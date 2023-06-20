<?php

namespace App\Http\Controllers;

use App\Http\Requests\SeminarioRequest;
use App\Models\Seminario;
use Illuminate\Http\Request;
use App\Models\Clase;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Google_Client;
use Google_Service_Calendar;

class SeminarioController extends Controller
{

    public function create(Request $request)
    {
        $request->validate([
            'image' => 'nullable|image',
            'fecha' => 'required',
            'tipo' => 'required',
            'ubi' => 'required_if:tipo,Presencial',
            'plataforma' => 'required_if:tipo,Virtual',
            'name' => 'required|string|max:255',
            'descripcion' => 'required',
            'precio' => 'required|numeric',
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

    public function agregarACalendario($id)
    {
        $clase = Clase::find($id);
        $seminario = $clase->claseable;

        $client = $this->getClient();
        $service = new Google_Service_Calendar($client);

        $event = new Google_Service_Calendar_Event([
            'summary' => $clase->nombre,
            'location' => $seminario->ubicacion,
            'description' => $clase->descripcion,
            'start' => [
                'dateTime' => $seminario->fecha,
                'timeZone' => 'America/New_York', // Ajusta la zona horaria según corresponda
            ],
            'end' => [
                'dateTime' => $seminario->fecha,
                'timeZone' => 'America/New_York',
            ],
        ]);

        $calendarId = 'primary'; // ID del calendario principal del usuario
        $event = $service->events->insert($calendarId, $event);

        return "El seminario se agregó correctamente a Google Calendar.";
    }

    private function getClient()
    {
        $client = new Google_Client();
        $client->setClientId(config('services.google.client_id'));
        $client->setClientSecret(config('services.google.client_secret'));
        $client->setRedirectUri(config('services.google.redirect'));
        $client->addScope(Google_Service_Calendar::CALENDAR);
        return $client;
    }

    public function comprar(Request $request)
    {
        $seminarioId = $request->input('seminarioId');

        // Realizar las acciones de compra con la ID del seminario

        // Por ejemplo, obtener el seminario según la ID
        $seminario = Seminario::find($seminarioId);

        $clase = $seminario->clase;

        $user = Auth::user();

        $estudiante = $user->userable;

        $estudiante->clases()->attach($clase);
        // Realizar acciones adicionales, como procesar el pago, guardar la información de la compra, etc.

        // Devolver una respuesta si es necesario
        return response()->json(['message' => 'Compra realizada con éxito: ' . $seminarioId]);
    }
}
