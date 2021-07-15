<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Cliente extends Model
{
    use LogsActivity;

    //Se define la tabla a la que apunta este modelo
    //Se define su primary key
    protected $table = 'Cliente';
    protected $primaryKey = 'ID_Cliente';
    public $timestamps = false;
    //Se definen los campos de la tabla
    protected $fillable = [
        'Nombre_Cliente',
        'Apellido_Cliente',
        'Cedula',
        'Correo',
        'Fecha_Ingreso',
        'Fecha_Realizacion',
        'Direccion'
    ];
}
