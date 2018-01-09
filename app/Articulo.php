<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Articulo extends Model
{
    protected $table = 'articulo'; //Tabla que hace referencia el Modelo

    protected $fillable = [ //Campos rellenables

    	'id_categoria',
    	'codigo',
    	'nombre',
    	'stock',
    	'descripcion',
    	'imagen',
    	'estado'
    ];

    public function categoria()
    {
    	//Un Articulo puede pertenecer a una Categoria
    	//belongsTo(Categoria::class) relaciona con categoria_id por default
    	return $this->belongsTo(Categoria::class, 'id_categoria');
    }
}
