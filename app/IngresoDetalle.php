<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class IngresoDetalle extends Model
{
    use LogsActivity;

    protected $guarded = [];
    protected $table = 'Ingreso_Detalle';
    protected $primaryKey = 'ID';
    public $timestamps = false;
    protected $fillable = [
        'Codigo_Ingreso',
        'ID_Producto',
        'Cantidad',
        'Precio'
    ];

    public function ingreso()
    {
        return $this->belongsTo(Ingreso::class, 'ID_Ingreso', 'ID_Ingreso');
    }

    public function producto()
    {
        return $this->belongsTo(Producto::class, 'ID_Producto', 'ID_Producto');
    }

    public function subtotal()
    {
        $precio = $this->Precio;
        $cantidad = $this->Cantidad;
        return $cantidad * $precio;
    }
}
