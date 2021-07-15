<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Nomina extends Model
{
    use LogsActivity;

    protected $table = 'Nomina_Empleado';
    protected $primaryKey = 'ID_Nomina';
    public $timestamps = false;
    protected $fillable = [
        'Año_Nomina',
        'Mes_Nomina',
        'Fecha_Generado',
        'Empleado_Genero',
        'Total_Bruto',
        'Total_Deducciones',
        'Total_Nomina'
    ];
}
