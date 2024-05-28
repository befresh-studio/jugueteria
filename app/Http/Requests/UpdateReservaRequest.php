<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateReservaRequest extends FormRequest
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
            'importe_total' => 'required|decimal:2',
            'importe_pagado' => 'required|decimal:2',
            'clientes_id' => 'required|exists:clientes,id',
            'comentarios' => 'nullable|string|max:2000'
        ];
    }
}
