@extends('layouts.admin')

@section('header')
	<h1>
		Editar Proveedor: {{ $persona->nombre }}
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

			<form action="{{ route('proveedor.update', $persona->id) }}" method="POST">
				<!-- <input name="_method" type="hidden" value="PUT"> -->
				{{ method_field('PUT') }}
				{{ csrf_field() }}

				<div class="col-md-6">
					<div class="form-group">
						<label for="nombre">Nombre</label>
						<input type="text" name="nombre" class="form-control" placeholder="Nombre" value="{{ $persona->nombre }}">
					</div>
					<div class="form-group">
						<label for="tipo_documento">Tipo de Documento</label>
						<select name="tipo_documento" class="form-control">
						@if($persona->tipo_documento == 'INE')
							<option value="INE" selected>INE</option>
							<option value="DNI">DNI</option>
							<option value="PAS">PAS</option>
						@elseif($persona->tipo_documento == 'DNI')
							<option value="INE">INE</option>
							<option value="DNI" selected>DNI</option>
							<option value="PAS">PAS</option>
						@else
							<option value="INE">INE</option>
							<option value="DNI">DNI</option>
							<option value="PAS" selected>PAS</option>
						@endif
						</select>
					</div>
					<div class="form-group">
						<label for="num_documento">Número de Documento</label>
						<input type="text" name="num_documento" class="form-control" placeholder="Número de Documento" value="{{ $persona->num_documento }}">
					</div>
				</div><!-- fin col-md -->

				<div class="col-md-6">
					<div class="form-group">
						<label for="direccion">Dirección</label>
						<input type="text" name="direccion" class="form-control" placeholder="Dirección" value="{{ $persona->direccion }}">
					</div>

					<div class="form-group">
						<label for="telefono">Teléfono</label>
						<input type="text" name="telefono" class="form-control" placeholder="Teléfono" value="{{ $persona->telefono }}">
					</div>

					<div class="form-group">
						<label for="email">Email</label>
						<input type="text" name="email" class="form-control" placeholder="Email" value="{{ $persona->email }}">
					</div>					
				</div><!-- fin col-md -->
				
				<div class="form-group">
					<button class="btn btn-primary" type="submit">
						Guardar
					</button>
					<button class="btn btn-danger" type="reset">
						Cancelar
					</button>
				</div>

			</form>

		</div>
	</div>

@stop