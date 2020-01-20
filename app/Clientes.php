<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Clientes extends Model
{
    protected $table = 'Cliente';
    protected $primaryKey = 'ID_Cliente';
    protected $timestamps = false;
    protected $fillable = [
        'Nombre_Cliente',
        'Apellido_Cliente',
        'Cedula',
        'Fecha_Ingreso',
        'Correo',
        'Fecha_Realizacion'
    ];

    protected $guarded= [];
}
