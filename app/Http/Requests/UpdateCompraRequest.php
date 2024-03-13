<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCompraRequest extends FormRequest
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
            'referencia' => 'required|string|max:10',
            'fecha_entrega' => 'required|date',
            'importe_total' => 'required|decimal:10:2',
            'iva' => 'required|decimal:10:2',
            'proveedores_id' => 'required|exists:proveedores,id'
        ];
    }
}
