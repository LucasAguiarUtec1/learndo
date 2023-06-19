<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SeminarioRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required',
            'descripcion' => 'required',
            'fecha' => 'required',
            'hora' => 'required',
            'duracion' => 'required',
            'cupos' => 'required',
            'image' => 'required|image',
            'participantes' => 'required_if:tipo,Presencial',
            'plataforma' => 'required_if:tipo,Virtual',
            'precio' => 'required',

        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     */




    public function messages()
    {
        return [
            'name.required' => 'El :attribute es obligatorio.',
            'descripcion.required' => 'La :attribute es obligatoria.',
            'fecha.required' => 'La :attribute es obligatoria.',
            'hora.required' => 'La :attribute es obligatoria.',
            'duracion.required' => 'La :attribute es obligatoria.',
            'cupos.required' => 'La :attribute es obligatoria.',
            'image.required' => 'La :attribute es obligatoria.',
            'participantes.required_if' => 'La :attribute es obligatoria.',
            'plataforma.required_if' => 'La :attribute es obligatoria.',
            'precio.required' => 'La :attribute es obligatoria.',
        ];
    }
}
