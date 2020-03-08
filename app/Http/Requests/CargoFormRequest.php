<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CargoFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'Nombre_Cargo' => 'required|max:60',
            'Salario_Cargo' => 'required|numeric|min:0'
            //
        ];
    }

    public function messages()
    {
        return [
            'Nombre_Cargo.required' => 'El nombre del cargo es requerido, no puede estar vacío',
            'Salario_Cargo.required' => 'El monto de salario es requerido, no puede estar vacío',
            'Salario_Cargo.numeric' => 'El monto de salario debe ser un numero valido, mayor que 0',
            'Salario_Cargo.min' => 'El monto de salario debe ser un numero mayor que 0'
        ];
    }
}
