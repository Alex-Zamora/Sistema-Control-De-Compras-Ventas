<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Categoria;
use App\Http\Requests\CategoriaFormRequest;

class CategoriaController extends Controller
{
    public function __construct()
    {

    }

    public function index(Request $request)
    {
    	if ($request)
    	{
            //trim() Elimina espacios en blanco al principio y al final
    		$query = trim($request->input('searchText'));

            // $categorias = Categoria::where([
            //         ['nombre', 'LIKE', "%$query%"],
            //         ['condicion', '=', '1'],
            //     ])
            //     ->orderBy('id', 'DESC')
            //     ->get();

    		$categorias = Categoria::where('nombre', 'LIKE', "%$query%")
    			->where('condicion','=','1')
    			->orderBy('id', 'DESC')
                ->paginate(5);

    		return view('almacen.categoria.index', [
				'categorias'=>$categorias, 
				'searchText'=>$query
			]);
    	}
    }

    public function create()
    {
    	return view('almacen.categoria.create');
    }

    public function store(CategoriaFormRequest $request)
    {
    	$categoria = new Categoria;
    	$categoria->nombre = $request->nombre;
    	$categoria->descripcion = $request->descripcion;
    	$categoria->condicion = '1';
    	$categoria->save();

    	return redirect('almacen/categoria');
    }

    public function show($id)
    {
    	$categoria = Categoria::findOrFail($id);
    	return view('almacen.categoria.show', ['categoria'=>$categoria]);
    }

    public function edit($id)
    {
    	$categoria = Categoria::findOrFail($id);
    	return view('almacen.categoria.edit', ['categoria'=>$categoria]);
    }

    public function update(CategoriaFormRequest $request, $id)
    {
    	$categoria = Categoria::findOrFail($id);
    	$categoria->nombre = $request->nombre;
    	$categoria->descripcion = $request->descripcion;
    	$categoria->update();

    	return redirect('almacen/categoria');
    }

    public function destroy($id)
    {
    	$categoria = Categoria::findOrFail($id);
    	$categoria->condicion = '0';
    	$categoria->update();

    	return redirect('almacen/categoria');
    }
}
