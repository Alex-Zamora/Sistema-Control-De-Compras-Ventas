@extends('layouts.admin')

@section('header')
	<h1>
		Nuevo Cliente
	</h1>
@endsection

@section('content')

	<div class="row">
		<div class="col-md-12 col-xs-12">
			@if(count($errors)>0)
			<div class="alert alert-danger">
				<ul>
					@foreach($errors->all() as $error)
						<li>{{ $error }}</li>
					@endforeach
				</ul>
			</div>
			@endif
			
			<form action="/ventas/cliente" method="POST">
				<input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
				
				<div class="col-md-6">
					<div class="form-group">
						<label for="nombre">Nombre</label>
						<input type="text" name="nombre" class="form-control" placeholder="Nombre" value="{{ old('nombre') }}">
					</div>
					<div class="form-group">
						<label for="tipo_documento">Tipo de Documento</label>
						<select name="tipo_documento" class="form-control">
							<option value="INE">INE</option>
							<option value="DNI">DNI</option>
							<option value="PAS">PAS</option>
						</select> 
					</div>
					<div class="form-group">
						<label for="num_documento">Número de Documento</label>
						<input type="text" name="num_documento" class="form-control" placeholder="Número de Documento" value="{{ old('num_documento') }}">
					</div>
				</div>

				<div class="col-md-6">
					<div class="form-group">
						<label for="direccion">Dirección</label>
						<input type="text" name="direccion" class="form-control" placeholder="Dirección" value="{{ old('direccion') }}">
					</div>

					<div class="form-group">
						<label for="telefono">Teléfono</label>
						<input type="text" name="telefono" class="form-control" placeholder="Teléfono" value="{{ old('telefono') }}">
					</div>

					<div class="form-group">
						<label for="email">Email</label>
						<input type="text" name="email" class="form-control" placeholder="Email" value="{{ old('email') }}">
					</div>					

				</div>
				
				<div class="col-md-12">
					<div class="form-group">
						<button class="btn btn-primary" type="submit">
							Guardar
						</button>
						<button class="btn btn-danger" type="reset">
							Cancelar
						</button>
					</div>
				</div>
			</form>

		</div>
	</div>

@endsection