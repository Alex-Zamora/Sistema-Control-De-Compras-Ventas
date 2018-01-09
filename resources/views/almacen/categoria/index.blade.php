@extends('layouts.admin')

@section('header')
	<h1>
		Listado de Categorías
	    <!-- <small>Optional description</small> -->
	</h1>
@endsection

@section('content')

	<div class="row">
		<div class="col-md-8 col-xs-12">
			@include('almacen.categoria.search')
		</div>
		<div class="col-md-2">
			<a href="categoria/create" class="pull-right">
				<button class="btn btn-success">Crear Categoría</button>
			</a>
		</div>		
	</div>

	<div class="row">
		<div class="col-md-12 col-xs-12">
			<div class="table-responsive">
				<table class="table table-striped table-hover">
					<thead>
						<th>Id</th>
						<th>Nombre</th>
						<th>Descripción</th>
						<th width="180">Opciones</th>
					</thead>
					<tbody>
						@foreach($categorias as $cat)
						<tr>
							<td>{{ $cat->id }}</td>
							<td>{{ $cat->nombre }}</td>
							<td>{{ $cat->descripcion }}</td>
							<td>
								<a href="{{ route('categoria.edit', $cat->id) }}">
									<button class="btn btn-info">Editar</button>
								</a>
								<a href="" data-target="#modal-delete-{{$cat->id}}" data-toggle="modal">
									<button class="btn btn-danger">Eliminar</button>
								</a>
							</td>
						</tr>

						@include('almacen.categoria.modal')

						@endforeach
					</tbody>
				</table>
			</div>
			{{ $categorias->render() }}
		</div>
	</div>

@endsection