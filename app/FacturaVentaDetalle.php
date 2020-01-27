<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FacturaVentaDetalle extends Model
{
    protected $table = 'Factura_Venta_Detalle';
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
