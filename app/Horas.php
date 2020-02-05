<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Horas extends Model
{
    protected $table = 'empleado_hora_laborada';
    protected $primaryKey = 'ID_Empleado';
    public $timestamps = false;
    protected $fillable = [
        'Fecha_Registro',
        'Horas_Laboradas'
    ];
}
