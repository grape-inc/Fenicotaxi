<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Arqueo extends Model
{

    use LogsActivity;

    protected $table = 'ArqueoCaja';
    protected $primaryKey = 'ID_Jornada';
    public $timestamps = false;
    protected $fillable = [
        'Saldo_Inicial', 'Saldo_Final', 'ID_Empleado', 'Fecha_Jornada',
        'Jornada_Abierta', 'B10', 'B20', 'B50', 'B100', 'B200', 'B500',
        'B1000', 'M025', 'M050', 'M1', 'M5', 'Fecha_Actualizacion',
        'Fecha_Caja', 'BD1', 'BD2', 'BD5', 'BD10', 'BD20', 'BD50',
        'BD100', 'Saldo_Final_Dolar', 'Centavos_Dolar', 'Centavos_Cordobas'
    ];

    public function getDescriptionForEvent(string $eventName): string
    {
        $user = session('Usuario');
        return "This model has been {$eventName} by \"{$user}\"";
    }
}
