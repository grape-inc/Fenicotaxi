<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $table = 'Producto';
    protected $primaryKey = 'ID_Producto';
    protected $timestamps = false;

    protected $fillable =[
        'Cod_Producto',
        'Codigo_Barra',
        'Nombre_Producto',
        'Descripcion_Producto',
        'Existencias',
        'Existencias_Minimas',
        'Imagen',
        'ID_Categoria',
        'ID_Proveedor',
        'ID_Divisa',
        'ID_UnidadMedida',
        'Es_Repuesto',
        'Año',
        'Modelo',
        'Origen',
        'Marca'
    ];
}
