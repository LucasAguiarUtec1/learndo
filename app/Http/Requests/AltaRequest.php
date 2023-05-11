<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AltaRequest extends FormRequest
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
            'password' => 'required|min:8',
            'password_confirmation' => 'required|same:password|min:8',
            'email' => 'required|email|unique:users,email',
            'nickname' => 'required|unique:users,nickname',
            'name' => 'required',
            'phone' => 'required|numeric',
        ];
    }

    public function attributes()
    {
        return [
            'password' => 'contraseña',
            'password_confirmation' => 'confirmación de contraseña',
            'email' => 'correo electrónico',
            'nickname' => 'nombre de usuario',
            'name' => 'nombre completo',
            'phone' => 'teléfono',
        ];
    }

    public function messages()
    {
        return [
            'password.required' => 'La :attribute es obligatoria.',
            'password.min' => 'La :attribute debe tener al menos :min caracteres.',
            'password_confirmation.confirmed' => 'La :attribute no coincide.',
            'password_confirmation.required' => 'La :attribute es obligatoria.',
            'password_confirmation.same' => 'La :attribute no coincide.',
            'email.required' => 'El :attribute es obligatorio.',
            'email.email' => 'El :attribute debe ser un correo electrónico válido.',
            'nickname.required' => 'El :attribute es obligatorio.',
            'name.required' => 'El :attribute es obligatorio.',
            'phone.required' => 'El :attribute es obligatorio.',
            'phone.numeric' => 'El :attribute debe ser un número.',
            'email.exists' => 'El :attribute ya está en uso.',
            'nickname.exists' => 'El :attribute ya está en uso.',

        ];
    }
}
