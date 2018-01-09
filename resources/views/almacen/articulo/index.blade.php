@extends('layouts.admin')

@section('header')
	<h1>
		Listado de Artículos
	</h1>
@endsection

@section('content')

	<div class="row">
		<div class="col-md-8 col-xs-12">
			@include('almacen.articulo.search')
		</div>
		<div class="col-md-2">
			<a href="articulo/create" class="pull-right">
				<button class="btn btn-success">Crear Artículo</button>
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
						<th>Código</th>
						<th>Stock</th>
						<th>Categoría</th>
						<th>Imágen</th>
						<th>Estado</th>
						<th width="180">Opciones</th>
					</thead>
					<tbody>
						@foreach($articulos as $art)
							<tr>
								<td>{{ $art->id }}</td>
								<td>{{ $art->nombre }}</td>
								<td>{{ $art->codigo }}</td>
								<td>{{ $art->stock }}</td>
								<td>{{ $art->categoria }}</td>
								<td>
									<img src="{{ asset('imagenes/articulos/'.$art->imagen) }}" alt="{{ $art->nombre }}" height="100" width="100" class="img-thumbnail">
								</td>
								<td>{{ $art->estado }}</td>
								<td>
									<a href="{{ route('articulo.edit', $art->id) }}">
										<button class="btn btn-info">Editar</button>
									</a>
									<a href="" data-target="#modal-delete-{{$art->id}}" data-toggle="modal">
										<button class="btn btn-danger">Eliminar</button>
									</a>
								</td>
							</tr>
						@include('almacen.articulo.modal')
						@endforeach
					</tbody>
				</table>
			</div>
		{{ $articulos->render() }}
		</div>
	</div>

@endsection