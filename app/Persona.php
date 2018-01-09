<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    protected $table = 'persona'; //Tabla que hace referencia el Modelo

    protected $primaryKey = 'id'; //Atributo primaryKey de la tabla categoria

    protected $fillable = [

    	'tipo_persona',
    	'nombre',
    	'tipo_documento',
    	'num_documento',
    	'direccion',
    	'telefono',
    	'email'

    ];
}
