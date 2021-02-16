<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClientesFormRequest extends FormRequest
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
            'Nombre_Cliente' => 'required|max:100',
            'Apellido_Cliente' => 'required|max:100',
            'Cedula' => 'required|max:20',
            'Correo' => 'email|max:100',
            'Direccion' => 'required|max:140'
        ];
    }

    public function messages()
    {
        return [
            'Nombre_Cliente.required' => 'El nombre del cliente es requerido, no puede estar vacio',
            'Apellido_Cliente.required'=> 'El apellido del  cliente es requerido, no puede estar vacio',
            'Cedula.required' => 'La cedula del cliente es requerida, no puede estar vacio',
        ];
    }
}
