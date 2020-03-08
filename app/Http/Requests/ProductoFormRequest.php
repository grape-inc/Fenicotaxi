<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductoFormRequest extends FormRequest
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
            'Cod_Producto' => 'required|max:20',
            'Codigo_Barra' => 'required|max:40',
            'Nombre_Producto' => 'required|max:70',
            'Descripcion_Producto' => 'max:200',
            'Existencias' => 'required|numeric',
            'Existencias_Minimas' => 'required|numeric',
            'Imagen' => 'mimes:jpeg,bmp,png',
            'ID_Categoria' => 'required|numeric',
            'ID_Proveedor' => 'required|numeric',
            'ID_Divisa' => 'required|numeric',
            'ID_UnidadMedida' => 'required|numeric',
            'Es_Repuesto' => 'required|boolean',
            'Año' => 'max:4',
            'Modelo' => 'max:80',
            'Origen' => 'max:100',
            'Marca' => 'max:80'
        ];
    }
}
