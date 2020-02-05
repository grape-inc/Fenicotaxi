<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cargo extends Model
{
    protected $table = 'cargo';
    protected $primaryKey = 'ID_Cargo';
    public $timestamps = false;
    protected $fillable = [
        'Nombre_Rol',
        'Salario_Cargo'
    ];
}
