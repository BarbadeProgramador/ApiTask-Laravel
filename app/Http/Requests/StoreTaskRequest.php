<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreTaskRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => 'required|max:100',
            'description' => 'required',
            'state' => 'required|in:Activo,Finalizado,En proceso',
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'El título es obligatorio.',
            'title.max' => 'El título no puede tener más de 100 caracteres.',
            'description.required' => 'La descripción es obligatoria.',
            'state.required' => 'El estado es obligatorio.',
            'state.in' => 'El estado debe ser uno de los siguientes: Activo, Finalizado o En proceso.',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'errors' => $validator->errors()
        ], 422));
    }
}
