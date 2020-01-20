<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DivisaForm extends FormRequest
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
            'ID_Divisa' => 'required',
            'Nombre_Divisa' => 'required|max:50',
            'Equivalencia_Cordoba' => 'required|numeric'
        ];
    }
}
