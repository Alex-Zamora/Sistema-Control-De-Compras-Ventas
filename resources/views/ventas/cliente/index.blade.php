@extends('layouts.admin')

@section('header')
	<h1>
		Listado de Clientes
	</h1>
@endsection

@section('content')

	<div class="row">
		<div class="col-md-8 col-xs-12">
			@include('ventas.cliente.search')
		</div>
		<div class="col-md-2">
			<a href="cliente/create" class="pull-right">
				<button class="btn btn-success">Crear Cliente</button>
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
						<th>tipo_documento</th>
						<th>num_documento</th>
						<th>telefono</th>
						<th>email</th>
						<th width="180">Opciones</th>
					</thead>
					<tbody>
						@foreach($personas as $per)
							<tr>
								<td>{{ $per->id }}</td>
								<td>{{ $per->nombre }}</td>
								<td>{{ $per->tipo_documento }}</td>
								<td>{{ $per->num_documento }}</td>
								<td>{{ $per->telefono }}</td>
								<td>{{ $per->email }}</td>
								<td>
									<a href="{{ route('cliente.edit', $per->id) }}">
										<button class="btn btn-info">Editar</button>
									</a>
									<a href="" data-target="#modal-delete-{{$per->id}}" data-toggle="modal">
										<button class="btn btn-danger">Eliminar</button>
									</a>
								</td>
							</tr>
						@include('ventas.cliente.modal')
						@endforeach
					</tbody>
				</table>
			</div>
		{{ $personas->render() }}
		</div>
	</div>

@endsection