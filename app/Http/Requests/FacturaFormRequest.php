<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FacturaFormRequest extends FormRequest
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
            'Codigo_Factura' => 'required|numeric',
            'ID_Divisa' => 'required',
            'ID_Empleado' => 'required',
            'Descuento' => 'required',
            'ID_Producto' => 'required',
            'Cantidad' => 'required',
            'Precio' => 'required',
            'Total_Facturado' => 'required|numeric|min:0'
        ];
    }

    public function messages()
    {
        return [
            'ID_Cliente.required' => 'El cliente es un campo requerido, no puede estar vacío',
            'Codigo_Factura.required' => 'El codigo de Factura es un campo requerido, no puede estar vacío',
            'ID_Empleado.required' => 'El empleado es un campo requerido, no puede estar vacío',
            'ID_Divisa.required' => 'El proveedor es un campo requerido, no puede estar vacío',
            'Total_Facturado.min' => 'El total debe ser mayor que 0',
            'ID_Producto.required' => 'Es necesario que agregue un producto',
            'Cantidad.required' => 'Es necesario que agregue la cantidad',
            'Precio.required' => 'Es necesario que agregue el precio',
            'Codigo_Factura.numeric' => 'La secuencia del codigo debe ser numerica'
        ];
    }
}
