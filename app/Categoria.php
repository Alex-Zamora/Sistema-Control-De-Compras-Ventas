<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $table = 'categoria'; //Tabla que hace referencia el Modelo

    protected $primaryKey = 'id'; //Atributo primaryKey de la tabla categoria

    protected $fillable = [

    	'nombre',
    	'descripcion',
    	'condicion'

    ];

    // protected $guarded = [];

    public function articulos()
    {
    	//Una Categoria puede tener muchos artículos
    	return $this->hasMany(Articulo::class);
    }

}
