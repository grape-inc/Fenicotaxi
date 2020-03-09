<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NominaDetalle extends Model
{
    protected $table = 'NominaDetalle';
    protected $primaryKey = 'ID_Nomina';
    public $timestamps = false;
    protected $fillable = [
        'ID_Empleado',
        'Salario_Bruto',
        'INSS_Laboral',
        'IR_Laboral',
        'Total_Neto',
        'Horas_Laboradas'
    ];
}
