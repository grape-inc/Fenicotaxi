<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Cargo extends Model
{
    use LogsActivity;

    protected $table = 'Cargo';
    protected $primaryKey = 'ID_Cargo';
    public $timestamps = false;
    protected $fillable = [
        'Nombre_Rol',
        'Salario_Cargo'
    ];
}
