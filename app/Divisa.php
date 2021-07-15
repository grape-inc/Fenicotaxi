<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Divisa extends Model
{

    use LogsActivity;

    protected $table = 'Divisa';
    protected $primaryKey = 'ID_Divisa';
    public $timestamps = false;

    protected $fillable = [
        'Nombre_Divisa',
        'Equivalencia_Cordoba'
    ];

    public function displayName()
    {
        $nombre = $this->Nombre_Divisa;

        return $nombre;
    }
}
