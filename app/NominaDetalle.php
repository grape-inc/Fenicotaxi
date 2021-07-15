<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class NominaDetalle extends Model
{
    use LogsActivity;

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
