<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Empleado extends Model
{

    use LogsActivity;

    protected $table = 'Empleado';
    protected $primaryKey = 'ID_Empleado';
    public $timestamps = false;

    protected $fillable = [
        'Nombre_Empleado',
        'Apellido_Empleado',
        'Fecha_Nacimiento',
        'Cedula',
        'Fecha_Ingreso',
        'Usuario',
        'Password',
        'Correo',
        'ID_Cargo',
        'Imagen',
        'ID_Rol',
    ];
}
