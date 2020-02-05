<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Abono extends Model
{
    protected $table = 'abono';
    protected $primaryKey = 'ID_Abono';
    protected $timestamps = false;
    protected $fillable = [
        'Numero_Factura',
        'Monto_Abonado',
        'Descripcion_Abono',
        'Fecha_Realizacion'
    ];
}
