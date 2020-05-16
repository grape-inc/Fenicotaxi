<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class IngresosFormRequest extends FormRequest
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
            'ID_Empleado' => 'required',
            'Impuesto' => 'required|numeric',
            'Total' => 'required|numeric|min:0',
            'Codigo_Ingreso' => 'required|numeric|min:0',
            'ID_Producto' => 'required',
            'Cantidad' => 'required',
            'Precio' => 'required',
            'ID_Divisa' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'ID_Proveedor.required' => 'El proveedor es un campo requerido, no puede estar vacío',
            'ID_Empleado.required' => 'El proveedor es un campo requerido, no puede estar vacío',
            'Total.min' => 'El total debe ser mayor que 0',
            'ID_Producto.required' => 'Es necesario que agregue un producto',
            'Cantidad.required' => 'Es necesario que agregue la cantidad',
            'Precio.required' => 'Es necesario que agregue el precio',
            'Codigo_Ingreso.required' => 'Es necesario introducir un codigo',
            'Codigo_Ingreso.numeric' => 'La secuencia del codigo debe ser numerica',
            'ID_Divisa.required' => 'Debe ingresesar un tipo de moneda'
        ];
    }
}
