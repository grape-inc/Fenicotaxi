<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ingreso extends Model
{
    protected $table = 'Ingreso';
    protected $primaryKey = 'ID_Ingreso';
    public $timestamps = false;
    protected $fillable = [
        'ID_Proveedor',
        'ID_Empleado',
        'Fecha_Realizacion',
        'Impuesto',
        'Total',
        'Codigo_Ingreso'
    ];
}
