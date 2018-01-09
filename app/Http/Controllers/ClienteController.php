<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PersonaFormRequest;
use App\Persona;
use DB;


class ClienteController extends Controller
{
    public function index(Request $request)
    {
    	if ($request)
    	{
            //trim() Elimina espacios en blanco al principio y al final
    		$query = trim($request->input('searchText'));

    		$personas = Persona::where('nombre', 'LIKE', "%$query%")
    			->where('tipo_persona','=','Cliente')
    			->orwhere('num_documento','LIKE', "%$query%")
    			->where('tipo_persona','=','Cliente')
    			->orderBy('id', 'DESC')
                ->paginate(5);

    		return view('ventas.cliente.index', [
				'personas'=>$personas, 
				'searchText'=>$query
			]);
    	}
    }

    public function create()
    {
    	return view('ventas.cliente.create');
    }

    public function store(PersonaFormRequest $request)
    {
    	$persona = new Persona;
    	$persona->tipo_persona = 'Cliente';
    	$persona->nombre = $request->get('nombre');
		$persona->tipo_documento = $request->get('tipo_documento');
		$persona->num_documento = $request->get('num_documento');
		$persona->direccion = $request->get('direccion');
		$persona->telefono = $request->get('telefono');
		$persona->email = $request->get('email');
    	$persona->save();

    	return redirect('ventas/cliente');
    }

    public function show($id)
    {
    	$persona = Persona::findOrFail($id);
    	return view('ventas.cliente.show', ['persona'=>$persona]);
    }

    public function edit($id)
    {
    	$persona = Persona::findOrFail($id);
    	return view('ventas.cliente.edit', ['persona'=>$persona]);
    }

    public function update(PersonaFormRequest $request, $id)
    {
    	$persona = Persona::findOrFail($id);

    	$persona->tipo_persona = 'Cliente';
    	$persona->nombre = $request->get('nombre');
		$persona->tipo_documento = $request->get('tipo_documento');
		$persona->num_documento = $request->get('num_documento');
		$persona->direccion = $request->get('direccion');
		$persona->telefono = $request->get('telefono');
		$persona->email = $request->get('email');
    	
    	$persona->update();

    	return redirect('ventas/cliente');
    }

    public function destroy($id)
    {
    	$persona = Persona::findOrFail($id);
    	$persona->tipo_persona = 'Inactivo';
    	$persona->update();

    	return redirect('ventas/cliente');
    }
}
