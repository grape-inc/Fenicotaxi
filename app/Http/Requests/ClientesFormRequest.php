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
            'ID_Cliente' => 'required',
            'Nombre_Cliente' => 'required|max:100',
            'Apellido_Cliente' => 'required|max1:00',
            'Cedula' => 'required|max20',
            'Fecha_Ingreso' => 'nullable|date',
            'Correo' => 'email|max:100',
            'Fecha_Realizacion' => 'nullable|date',
        ];
    }
}
