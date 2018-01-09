<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetalleIngreso extends Model
{
    protected $table = 'detalle_ingreso'; 

    protected $primaryKey = 'id';

    protected $fillable = [

    	'id_ingreso',
    	'id_articulo',
    	'cantidad',
    	'precio_comrpa',
    	'precio_venta'

    ];
}
