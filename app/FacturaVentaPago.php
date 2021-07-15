<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class FacturaVentaPago extends Model
{
    use LogsActivity;

    protected $table = 'factura_venta_pago';
    public $timestamps = false;
    protected $fillable = [
        'factura_venta_id',
        'tipo_pago_id',
        'tipo_divisa_id',
        'monto'
    ];
}
