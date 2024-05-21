<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PeticionRequest extends FormRequest
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
        return [
            'numero_radicado' => 'required',
            'asunto' => 'required',
            'descripcion' => 'required',
            'categoria' => 'required|in:especial,informacion,general,consulta',
            'user_id' => 'required|array',
            'user_id.*' => 'exists:users,id'
        ];
    }
}
