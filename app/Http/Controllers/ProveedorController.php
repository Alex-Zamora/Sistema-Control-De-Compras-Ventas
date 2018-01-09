<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PersonaFormRequest;
use App\Persona;
use DB;

class ProveedorController extends Controller
{
    public function index(Request $request)
    {
    	if ($request)
    	{
            //trim() Elimina espacios en blanco al principio y al final
    		$query = trim($request->input('searchText'));

    		$personas = Persona::where('nombre', 'LIKE', "%$query%")
    			->where('tipo_persona','=','Proveedor')
    			->orwhere('num_documento','LIKE', "%$query%")
    			->where('tipo_persona','=','Proveedor')
    			->orderBy('id', 'DESC')
                ->paginate(5);

    		return view('compras.proveedor.index', [
				'personas'=>$personas, 
				'searchText'=>$query
			]);
    	}
    }

    public function create()
    {
    	return view('compras.proveedor.create');
    }

    public function store(PersonaFormRequest $request)
    {
    	$persona = new Persona;
    	$persona->tipo_persona = 'Proveedor';
    	$persona->nombre = $request->get('nombre');
		$persona->tipo_documento = $request->get('tipo_documento');
		$persona->num_documento = $request->get('num_documento');
		$persona->direccion = $request->get('direccion');
		$persona->telefono = $request->get('telefono');
		$persona->email = $request->get('email');
    	$persona->save();

    	return redirect('compras/proveedor');
    }

    public function show($id)
    {
    	$persona = Persona::findOrFail($id);
    	return view('compras.proveedor.show', ['persona'=>$persona]);
    }

    public function edit($id)
    {
    	$persona = Persona::findOrFail($id);
    	return view('compras.proveedor.edit', ['persona'=>$persona]);
    }

    public function update(PersonaFormRequest $request, $id)
    {
    	$persona = Persona::findOrFail($id);

    	$persona->tipo_persona = 'Proveedor';
    	$persona->nombre = $request->get('nombre');
		$persona->tipo_documento = $request->get('tipo_documento');
		$persona->num_documento = $request->get('num_documento');
		$persona->direccion = $request->get('direccion');
		$persona->telefono = $request->get('telefono');
		$persona->email = $request->get('email');
    	
    	$persona->update();

    	return redirect('compras/proveedor');
    }

    public function destroy($id)
    {
    	$persona = Persona::findOrFail($id);
    	$persona->tipo_persona = 'Inactivo';
    	$persona->update();

    	return redirect('compras/proveedor');
    }
}
