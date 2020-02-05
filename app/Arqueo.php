<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Arqueo extends Model
{
    protected $table = 'arqueoCaja';
    protected $primaryKey = 'ID_Jornada';
    public $timestamps = false;
    protected $fillable = [
        'Saldo_Inicial',
        'Saldo_Final',
        'ID_Empleado',
        'Fecha_Jornada',
        'Jornada_Abierta',
        'B10',
        'B20',
        'B50',
        'B100',
        'B200',
        'B500',
        'B1000',
        'M025',
        'M050',
        'M1',
        'M5',
        'Fecha_Actualizacion',
        'Fecha_Caja'
    ];
}
