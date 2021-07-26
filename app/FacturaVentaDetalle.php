<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class FacturaVentaDetalle extends Model
{

    use LogsActivity;

    protected $table = 'Factura_Venta_Detalle';
    public $timestamps = false;
    protected $fillable = [
        'ID_Producto',
        'Cantidad',
        'Descuento_Individual',
        'Precio',
        'Observacion'
    ];

    public function getDescriptionForEvent(string $eventName): string
    {
        $user = session('Usuario');
        return "This model has been {$eventName} by \"{$user}\"";
    }
}
