<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Horas extends Model
{
    use LogsActivity;

    protected $table = 'Empleado_Hora_Laborada';
    protected $primaryKey = 'ID_Empleado';
    public $timestamps = false;
    protected $fillable = [
        'Fecha_Registro',
        'Horas_Laboradas'
    ];
}
