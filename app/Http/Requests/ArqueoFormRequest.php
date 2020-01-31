<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArqueoFormRequest extends FormRequest
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
            'Saldo_Inicial' => 'required|numeric|min:0',
            'Saldo_Final' => 'nullable|numeric|min:0',
            'ID_Empleado' => 'required',
            'Fecha_Jornada' => 'nullable',
            'Jornada_Abierta' => 'nullable',
            'B10' => 'nullable|numeric|min:0',
            'B20' => 'nullable|numeric|min:0',
            'B50' => 'nullable|numeric|min:0',
            'B100' => 'nullable|numeric|min:0',
            'B200' => 'nullable|numeric|min:0',
            'B500' => 'nullable|numeric|min:0',
            'B1000' => 'nullable|numeric|min:0',
            'M025' => 'nullable|numeric|min:0',
            'M050' => 'nullable|numeric|min:0',
            'M1' => 'nullable|numeric|min:0',
            'M5' => 'nullable|numeric|min:0',
        ];
    }

    public function messages()
    {
        return [
            'Saldo_Inicial.min' => 'El saldo inicial debe ser mayor que 0',
            'Saldo_Final.min' => 'El saldo final debe ser mayor que 0',
            'ID_Empleado.required' => 'El empleado es requerido para abrir caja'
        ];
    }
}
