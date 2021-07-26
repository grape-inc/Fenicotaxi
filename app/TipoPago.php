<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class TipoPago extends Model
{
    use LogsActivity;

    protected $table = 'tipo_pago';
    protected $primaryKey = 'ID';
    public $timestamps = false;
    protected $fillable = [
        'Tipo_Pago'
    ];

    public function getDescriptionForEvent(string $eventName): string
    {
        $user = session('Usuario');
        return "This model has been {$eventName} by \"{$user}\"";
    }
}
