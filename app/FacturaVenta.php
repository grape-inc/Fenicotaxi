<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class FacturaVenta extends Model
{
    use LogsActivity;

    protected $table = 'Factura_Venta';
    protected $primaryKey = 'ID_Factura';
    public $timestamps = false;
    protected $fillable = [
        'Codigo_Factura',
        'ID_Divisa',
        'Es_Credito',
        'Descuento',
        'SubTotal',
        'Total_Facturado',
        'ID_Empleado',
        'Fecha_Realizacion',
        'Fecha_Actualizacion',
        'ID_Cliente',
        'Monto_Restante',
        'ID_Jornada',
        'Observacion'
    ];

    public function getDescriptionForEvent(string $eventName): string
    {
        $user = session('Usuario');
        return "This model has been {$eventName} by \"{$user}\"";
    }
}
