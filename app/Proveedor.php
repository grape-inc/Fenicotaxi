<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    protected $table = 'Proveedor';
    protected $primaryKey = 'ID_Proveedor';
    public $timestamps = false;

    protected $fillable = [
        'Nombre_Proveedor',
        'Direccion_Proveedor',
        'Telefono',
        'Logo',
    ];

    protected $guarded = [
    ];
}
