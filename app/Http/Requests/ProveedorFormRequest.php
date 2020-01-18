<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProveedorFormRequest extends FormRequest
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
            'ID_Proveedor' => 'required',
            'Direccion_Proveedor' => 'required|max:60',
            'Telefono' => 'required|max:20',
            'Logo' => 'mimes:jpeg,bmp,png'
        ];
    }
}
