<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Ingreso extends Model
{
    use LogsActivity;

    protected $guarded = [];
    protected $table = 'Ingreso';
    protected $primaryKey = 'ID_Ingreso';
    public $timestamps = false;
    protected $fillable = [
        'ID_Proveedor',
        'ID_Empleado',
        'Fecha_Realizacion',
        'Impuesto',
        'Total',
        'Codigo_Ingreso',
        'ID_Divisa'
    ];

    public function ingreso_detalles()
    {
        return $this->hasMany(IngresoDetalle::class, 'ID_Ingreso');
    }

    public function divisa()
    {
        return $this->belongsTo(Divisa::class, 'ID_Divisa', 'ID_Divisa');
    }

    public function getDescriptionForEvent(string $eventName): string
    {
        $user = session('Usuario');
        return "This model has been {$eventName} by \"{$user}\"";
    }
}
