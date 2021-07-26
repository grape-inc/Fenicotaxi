<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Proveedor extends Model
{
    use LogsActivity;

    protected $table = 'Proveedor';
    protected $primaryKey = 'ID_Proveedor';
    public $timestamps = false;

    protected $fillable = [
        'Nombre_Proveedor',
        'Direccion_Proveedor',
        'Telefono',
        'Contacto_Proveedor',
    ];

    protected $guarded = [
    ];

    public function getDescriptionForEvent(string $eventName): string
    {
        $user = session('Usuario');
        return "This model has been {$eventName} by \"{$user}\"";
    }
}
