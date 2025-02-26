<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterMovementRequest extends FormRequest
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
            'producto_id' => 'required|exists:inventarios,id',
            'tipo' => 'required|in:entrada,salida',
            'cantidad' => 'required|numeric|min:1',
            'descripcion' => 'required|string|max:255'
        ];
    }
}
