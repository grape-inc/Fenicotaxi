<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CategoriaProducto extends Model
{
    //Se define la tabla a la que apunta este modelo
    //Se define su primary key
    protected $table = 'categoria_producto';
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
