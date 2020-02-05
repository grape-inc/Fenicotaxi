<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    //Se define la tabla a la que apunta este modelo
    //Se define su primary key
    protected $table = 'cliente';
    protected $primaryKey = 'ID_Cliente';
    public $timestamps = false;
    //Se definen los campos de la tabla
    protected $fillable = [
        'Nombre_Cliente',
        'Apellido_Cliente',
        'Cedula',
        'Correo',
        'Fecha_Ingreso',
        'Fecha_Realizacion'
    ];
}
