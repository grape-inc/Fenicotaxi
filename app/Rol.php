<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Rol extends Model
{
    use LogsActivity;

    protected $table = 'Rol';
    protected $primaryKey = 'ID_Rol';
    public $timestamps = false;
    protected $fillable = [
        'Nombre_Rol'
    ];

    public function getDescriptionForEvent(string $eventName): string
    {
        $user = session('Usuario');
        return "This model has been {$eventName} by \"{$user}\"";
    }
}
