<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreJugueteRequest extends FormRequest
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
            'imagen' => 'required|string|max:255',
            'nombre' => 'required|string|max:100',
            'referencia' => 'required|string|max:20',
            'ean13' => 'required|string|max:100',
            'precio' => 'required',
            'stock' => 'required',
        ];
    }
}