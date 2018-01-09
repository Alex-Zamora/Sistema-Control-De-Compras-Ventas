@extends('layouts.admin')

@section('header')
	<h1>
		Editar Categoría: {{ $categoria->nombre }}
	</h1>
@endsection

@section('content')

	<div class="row">
		<div class="col-md-6 col-xs-12">
			@if(count($errors)>0)
			<div class="alert alert-danger">
				<ul>
					@foreach($errors->all() as $error)
						<li>{{ $error }}</li>
					@endforeach
				</ul>
			</div>
			@endif
			
			<form action="{{ route('categoria.update', $categoria->id) }}" method="POST">
				<!-- <input name="_method" type="hidden" value="PUT"> -->
				{{ method_field('PUT') }}
				{{ csrf_field() }}

				<div class="form-group">
					<label for="nombre">Nombre</label>
					<input type="text" name="nombre" class="form-control" 
						value="{{ $categoria->nombre }}" 
						placeholder="{{ $categoria->nombre }}">
				</div>
				<div class="form-group">
					<label for="descripcion">Descripción</label>
					<input type="text" name="descripcion" class="form-control"
						value="{{ $categoria->descripcion }}"
						placeholder="{{ $categoria->descripcion }}">
				</div>
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