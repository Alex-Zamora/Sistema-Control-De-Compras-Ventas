<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Http\Requests\ArticuloFormRequest;
use App\Articulo;
use DB;

class ArticuloController extends Controller
{
    public function __construct()
    {

    }

    public function index(Request $request)
    {
    	if ($request)
    	{
            // $articulos = Articulo::with('categoria')->get();         
            // var_dump(Articulo::find(1)->categoria);
            // var_dump(DB::getQueryLog());

    		$query = trim($request->input('searchText'));

            $articulos = DB::table('articulo as a')
            ->join('categoria as c', 'a.id_categoria', '=', 'c.id')
            ->select('a.id', 'a.nombre', 'a.codigo', 'a.stock', 'a.descripcion', 'a.imagen', 'a.estado', 'c.nombre as categoria')
            ->where('a.nombre', 'LIKE', "%$query%")
            ->orwhere('a.codigo', 'LIKE', "%$query%")
            ->orderBy('a.id', 'DESC')
            ->paginate(5);

    		return view('almacen.articulo.index', [
				'articulos'=>$articulos, 
				'searchText'=>$query
			]);
    	}
    }

    public function create()
    {
        //Para el select form
        $categorias = DB::table('categoria')->where('condicion', '=', '1')->get();

        return view('almacen.articulo.create',['categorias' => $categorias]);
    }

    public function store(ArticuloFormRequest $request)
    {
        //Nuevo objeto
        $articulo = new Articulo;
        $articulo->id_categoria = $request->get('id_categoria');
        $articulo->codigo = $request->get('codigo');
        $articulo->nombre = $request->get('nombre');
        $articulo->stock = $request->get('stock');
        $articulo->descripcion = $request->get('descripcion');
        $articulo->estado = 'Activo';

        if (Input::hasFile('imagen')) //Si tiene imagen el campo imagen
        {
            $file = Input::file('imagen'); //Almacenar en $file el archivo
            $file->move(public_path().'/imagenes/articulos/', $file->getClientOriginalName()); //Guardamos la imagen y la movemos a la ruta con el nombre original
            $articulo->imagen = $file->getClientOriginalName();
        }

        $articulo->save();
        return redirect('almacen/articulo');
    }

    public function show($id)
    {
        return view('almacen.articulo.show', 
            ['articulo'=>Articulo::findOrFail($id)]);
    }

    public function edit($id)
    {
        $articulo = Articulo::findOrFail($id);
        //$categorias para el select form
        $categorias = DB::table('categoria')->where('condicion', '=', '1')->get();

        return view('almacen.articulo.edit',[
            'articulo' => $articulo,
            'categorias' => $categorias
            ]);
    }

    public function update(ArticuloFormRequest $request, $id)
    {
        $articulo = Articulo::findOrFail($id);
        $articulo->id_categoria = $request->get('id_categoria');
        $articulo->codigo = $request->get('codigo');
        $articulo->nombre = $request->get('nombre');
        $articulo->stock = $request->get('stock');
        $articulo->descripcion = $request->get('descripcion');
        $articulo->estado = 'Activo';

        if (Input::hasFile('imagen')) //Si tiene imagen el campo imagen
        {
            $file = Input::file('imagen'); //Almacenar en $file el archivo
            $file->move(public_path().'/imagenes/articulos/', $file->getClientOriginalName()); //Guardamos la imagen y la movemos a la ruta con el nombre original
            $articulo->imagen = $file->getClientOriginalName();
        }

        $articulo->update();
        return redirect('almacen/articulo');

    }

    public function destroy($id)
    {
        $articulo = Articulo::findOrFail($id);
        $articulo->estado = 'Inactivo';
        $articulo->update();
        return redirect('almacen/articulo');
    }

}