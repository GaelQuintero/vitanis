<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Reglas de validación.
     */
    public function rules(): array
    {
        return [
            'nombre' => ['required', 'min:3', 'max:50'],
            'descripcion' => ['required', 'min:3', 'max:255'],
            'codigo' => ['required', 'unique:inventarios', 'min:3', 'max:20'],
            'cantidad_actual' => ['required', 'numeric', 'min:0'],
            'precio' => ['required', 'numeric', 'min:0'],
            'categoria_id' => ['required', 'exists:categorias,id'],

        ];
    }
}
