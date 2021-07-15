<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class UnidadMedida extends Model
{
    use LogsActivity;

    protected $table = 'Unidad_Medida';
    protected $primaryKey = 'ID_Unidad';
    public $timestamps = false ;
    protected $fillable = [
        'Nombre_Unidad'
    ];

    protected $guarded =[];
}
