<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Abono extends Model
{
    use LogsActivity;

    protected $table = 'Abono';
    protected $primaryKey = 'ID_Abono';
    protected $timestamps = false;
    protected $fillable = [
        'Numero_Factura',
        'Monto_Abonado',
        'Descripcion_Abono',
        'Fecha_Realizacion'
    ];
}
