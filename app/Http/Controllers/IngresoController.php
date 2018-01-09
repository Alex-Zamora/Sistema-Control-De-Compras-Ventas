<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Http\Requests\IngresoFormRequest;
use App\Ingreso;
use App\DetalleIngreso;
use DB;

use Carbon\Carbon;
use Response;
use Illuminate\Support\Collection;

class IngresoController extends Controller
{
    public function index(Request $request)
    {
    	if ($request)
    	{
    		$query = trim($request->input('searchText'));

    		//DB::raw() permite escribir sentencias SQL en crudo
    		$ingresos = DB::table('ingreso as i')
    		->join('persona as p', 'p.id', '=', 'i.id_proveedor')
    		->join('detalle_ingreso as di', 'di.id_ingreso', '=', 'i.id')
    		->select('p.nombre', 'i.id', 'i.tipo_comprobante', 
    			'i.serie_comprobante', 'i.num_comprobante', 'i.impuesto', 'i.estado', DB::raw('sum(di.cantidad * di.precio_comrpa) as total'))
    		->where('i.num_comprobante', 'LIKE', "%$query%")
    		->orderBy('i.id', 'DESC')
    		->groupBy('p.nombre', 'i.id', 'i.tipo_comprobante', 
    			'i.serie_comprobante', 'i.num_comprobante', 'i.impuesto', 'i.estado')
    		->paginate(5);

    		return view('compras.ingreso.index', [
    					'ingresos' => $ingresos, 
    					'searchText' => $query]);
    	}
    }

    public function create()
    {
    	$personas = DB::table('persona')->where('tipo_persona', '=', 'Proveedor')->get();
    	$articulos = DB::table('articulo as art')
    		->select(DB::raw('CONCAT(art.codigo, " - ", art.nombre) AS articulo'), 
    						'art.id' )
    		->where('art.estado', '=', 'Activo')
    		->get(); 

    	return view('compras.ingreso.create', [
    				'personas' => $personas,
    				'articulos' => $articulos]);
    }

    public function store(IngresoFormRequest $request)
    {
    	//Capturador de excepciones try
    	//Transacción para asegurar los datos
    	// dd($request);
    	try {
    		DB::beginTransaction();

    		$ingreso = new Ingreso;
    		$ingreso->id_proveedor = $request->get('id_proveedor');
    		$ingreso->tipo_comprobante = $request->get('tipo_comprobante');
    		$ingreso->serie_comprobante = $request->get('serie_comprobante');
    		$ingreso->num_comprobante = $request->get('num_comprobante');
    		$ingreso->impuesto = 18;
    		$ingreso->estado = 'A';
    		$ingreso->save();

    		//Artículos array()
    		//Tabla detalle_ingreso
    		$id_articulo = $request->get('id_articulo'); //array()
    		$cantidad = $request->get('cantidad');
    		$precio_compra = $request->get('precio_compra');
    		$precio_venta = $request->get('precio_venta');

    		dd($id_articulo);

    		//Recorre los detalles de ingreso
    		$cont = 0;

    		while($cont < count($id_articulo))
    		{
    			$detalle = new DetalleIngreso;
    			//$ingreso->id del ingreso que recien se guardo 
    			$detalle->id_ingreso = $ingreso->id;
    			//id_articulo de la posición cero
    			$detalle->id_articulo = $id_articulo[$cont];
    			$detalle->cantidad = $cantidad[$cont];
    			$detalle->precio_comrpa = $precio_compra[$cont];
    			$detalle->precio_venta = $precio_venta[$cont];
    			$detalle->save();

    			$cont = $cont + 1;
    		}

    		DB::commit();
    	} catch (Exception $e) {
    		//Si existe algún error en la Transacción
    		DB::rollback(); //Anular los cambios en la DB
    	}

    	return redirect('compras/ingreso');
    }

    public function show($id)
    {
    	//Cabecera
    	$ingreso = DB::table('ingreso as i')
    		->join('persona as p', 'p.id', '=', 'i.id_proveedor')
    		->join('detalle_ingreso as di', 'di.id_ingreso', '=', 'i.id')
    		->select('i.id', 'p.nombre', 'i.tipo_comprobante', 
    			'i.serie_comprobante', 'i.impuesto', 'i.estado',
    			DB::raw('sum(di.cantidad * di.precio_compra) as total'))
    		//Solo obtener un ingreso
    		->where('i.id', '=', $id)
    		->first();

    	//Detalles
    	$detalles = DB::table('detalle_ingreso as d')
    			//Unir detale_ingreso con la tabla articulo
    			->join('articulo as a', 'a.id', '=', 'd.id_articulo')
    			->select('a.nombre', 'd.cantidad', 'd.precio_compra', 'd.precio_venta')
    			->where('d.id_ingreso', '=', $id)
    			->get();

    	return view('compras.ingreso.show', [
    				'ingreso' => $ingreso,
    				'detalles' => $detalles
    			]);
    }

    //Cancelar un ingreso
    public function destroy($id)
    {
    	$ingreso = new Ingreso;
    	$ingreso->estado = 'C'; //Cancelado
    	$ingreso->update();
    	return redirect('compras/ingreso');
    }
}
