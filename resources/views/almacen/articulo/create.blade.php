@extends('layouts.admin')

@section('header')
	<h1>
		Nuevo Artículo
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
			
			<form action="/almacen/articulo" method="POST" enctype="multipart/form-data">
				<input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
				
				<div class="col-md-6">
					<div class="form-group">
						<label for="nombre">Nombre</label>
						<input type="text" name="nombre" class="form-control" placeholder="Nombre" value="{{ old('nombre') }}">
					</div>
					<div class="form-group">
						<label for="codigo">Código</label>
						<input type="text" name="codigo" class="form-control" placeholder="Código" value="{{ old('codigo') }}"> 
					</div>
					<div class="form-group">
						<label for="stock">Stock</label>
						<input type="text" name="stock" class="form-control" placeholder="Stock" value="{{ old('stock') }}">
					</div>
				</div>

				<div class="col-md-6">
					<div class="form-group">
						<label for="id_categoria">Categoría</label>
						<select name="id_categoria" class="form-control">
							@foreach($categorias as $cat)
								<option value="{{ $cat->id }}">{{ $cat->nombre }}</option>
							@endforeach
						</select>
					</div>

					<div class="form-group">
						<label for="descripcion">Descripción</label>
						<input type="text" name="descripcion" class="form-control" placeholder="Descripción" value="{{ old('descripcion') }}">
					</div>

					<div class="form-group">
						<label for="imagen">Imágen</label>
						<input type="file" name="imagen">
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