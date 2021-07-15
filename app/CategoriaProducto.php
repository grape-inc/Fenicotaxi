<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class CategoriaProducto extends Model
{
    use LogsActivity;
    //Se define la tabla a la que apunta este modelo
    //Se define su primary key
    protected $table = 'Categoria_Producto';
    protected $primaryKey = 'ID_Categoria';
    public $timestamps = false;
    //Se definen los campos de la tabla
    protected $fillable = [
        'Nombre_Categoria',
        'Descripcion_Categoria'
    ];

    protected $guarded = [
    ];
}
