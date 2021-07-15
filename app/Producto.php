<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Producto extends Model
{
    use LogsActivity;

    protected $table = 'Producto';
    protected $primaryKey = 'ID_Producto';
    public $timestamps = false;

    protected $fillable =[
        'Cod_Producto',
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

    public function displayName()
    {
        $codigo = $this->Cod_Producto;
        $nombre = $this->Nombre_Producto;

        return $codigo." / ".$nombre;
    }
}
