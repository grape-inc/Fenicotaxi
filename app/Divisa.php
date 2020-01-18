<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Divisa extends Model
{
    protected $table = 'Divisa';
    protected $primaryKey = 'ID_Divisa';
    protected $timestamps = false;

    protected $fillable = [
        'Nombre_Divisa',
        'Equivalencia_Cordoba'
    ];
}
