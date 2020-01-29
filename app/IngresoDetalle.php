<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IngresoDetalle extends Model
{
    protected $table = 'Ingreso_Detalle';
    protected $primaryKey = 'ID';
    public $timestamps = false;
    protected $fillable = [
        'ID_Ingreso',
        'ID_Producto',
        'Cantidad',
        'Precio'
    ];
}
