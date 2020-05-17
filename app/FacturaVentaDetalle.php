<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FacturaVentaDetalle extends Model
{
    protected $table = 'Factura_Venta_Detalle';
    public $timestamps = false;
    protected $fillable = [
        'ID_Producto',
        'Cantidad',
        'Descuento_Individual',
        'Precio',
        'Observacion'
    ];
}
