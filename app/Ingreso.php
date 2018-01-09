<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ingreso extends Model
{
    protected $table = 'ingreso'; 

    protected $primaryKey = 'id';

    protected $fillable = [

		'id_proveedor',
		'tipo_comprobante',
		'serie_comprobante',
		'num_comprobante',
    	'impuesto',
    	'estado'

    ];
}
