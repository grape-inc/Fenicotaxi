<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IngresoDetalle extends Model
{
    protected $table = 'ingreso_detalle';
    protected $primaryKey = 'ID';
    public $timestamps = false;
    protected $fillable = [
        'Codigo_Ingreso',
        'ID_Producto',
        'Cantidad',
        'Precio'
    ];
}
