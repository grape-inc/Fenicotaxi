<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UnidadMedida extends Model
{
    protected $table = 'Unidad_Medida';
    protected $primaryKey = 'ID_Unidad';
    public $timestamps = false ;
    protected $fillable = [
        'Nombre_Unidad'
    ];

    protected $guarded =[];
}
