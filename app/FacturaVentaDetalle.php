<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FacturaVentaDetalle extends Model
{
    protected $table = 'factura_venta_detalle';
    protected $primaryKey = 'ID_Factura';
    public $timestamps = false;
    protected $fillable = [
        'Linea_Detalle',
        'ID_Producto',
        'Cantidad',
        'Descripcion',
        'Descuento_Individual'
    ];
}
