<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoPago extends Model
{
    protected $table = 'tipo_pago';
    protected $primaryKey = 'ID';
    public $timestamps = false;
    protected $fillable = [
        'Tipo_Pago'
    ];
}
