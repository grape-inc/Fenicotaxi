<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    protected $table = 'proveedor';
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
}
