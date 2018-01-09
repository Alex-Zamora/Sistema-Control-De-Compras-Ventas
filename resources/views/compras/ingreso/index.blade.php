@extends('layouts.admin')

@section('header')
	<h1>
		Listado de Ingreso
	</h1>
@endsection

@section('content')

	<div class="row">
		<div class="col-md-8 col-xs-12">
			@include('compras.ingreso.search')
		</div>
		<div class="col-md-2">
			<a href="ingreso/create" class="pull-right">
				<button class="btn btn-success">Crear Ingreso</button>
			</a>
		</div>		
	</div>

	<div class="row">
		<div class="col-md-12 col-xs-12">
			<div class="table-responsive">
				<table class="table table-striped table-hover">
					<thead>
						<th>Id</th>
						<th>Fecha</th>
						<th>Proveedor</th>
						<th>Comprobante</th>
						<th>Impuesto</th>
						<th>Total</th>
						<th>Estado</th>
						<th width="180">Opciones</th>
					</thead>
					<tbody>
						@foreach($ingresos as $ing)
						<tr>
							<td>{{ $ing->id }}</td>
							<td></td>
							<td>{{ $ing->nombre }}</td>
							<td>
							{{ $ing->tipo_comprobante. ': ' .$ing->serie_comprobante. 
							' - ' .$ing->num_comprobante }}
							</td>
							<td>{{ $ing->impuesto }}</td>
							<td>{{ $ing->total }}</td>
							<td>{{ $ing->estado }}</td>
							<td>
								<a href="{{ route('ingreso.show', $ing->id) }}">
									<button class="btn btn-primary">
										Detalles
									</button>
								</a>
								<a href="" data-target="#modal-delete-{{$ing->id}}" data-toggle="modal">
									<button class="btn btn-danger">
										Anular
									</button>
								</a>
							</td>
						</tr>
						@include('compras.ingreso.modal')
						@endforeach
					</tbody>
				</table>
			</div>
		{{ $ingresos->render() }}
		</div>
	</div>

@endsection