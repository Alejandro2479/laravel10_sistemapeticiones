<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        // Obtener el usuario actual
        $user = $this->route('user');

        // Definir las reglas básicas
        $rules = [
            'name' => 'required',
            'password' => 'required|min:6'
        ];

        // Agregar reglas para username y email solo si han sido modificados
        if ($user) {
            $rules['username'] = 'required|unique:users,username,' . $user->id;
            $rules['email'] = 'required|email|unique:users,email,' . $user->id;
        } else {
            $rules['username'] = 'required|unique:users,username';
            $rules['email'] = 'required|email|unique:users,email';
        }

        return $rules;
    }
}
