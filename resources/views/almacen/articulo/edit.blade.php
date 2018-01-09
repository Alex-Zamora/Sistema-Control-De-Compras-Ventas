@extends('layouts.admin')

@section('header')
	<h1>
		Editar Artículo: {{ $articulo->nombre }}
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
		
		


			<form action="{{ route('articulo.update', $articulo->id) }}" method="POST" enctype="multipart/form-data">
				<!-- <input name="_method" type="hidden" value="PUT"> -->
				{{ method_field('PUT') }}
				{{ csrf_field() }}

				<div class="col-md-6">
					<div class="form-group">
						<label for="nombre">Nombre</label>
						<input type="text" name="nombre" class="form-control"  value="{{ $articulo->nombre }}">
					</div>
					<div class="form-group">
						<label for="codigo">Código</label>
						<input type="text" name="codigo" class="form-control" value="{{ $articulo->codigo }}"> 
					</div>
					<div class="form-group">
						<label for="stock">Stock</label>
						<input type="text" name="stock" class="form-control" value="{{ $articulo->stock }}">
					</div>
				</div>

				<div class="col-md-6">
					<div class="form-group">
						<label for="id_categoria">Categoría</label>
						<select name="id_categoria" class="form-control">
							@foreach($categorias as $cat)
								@if($cat->id == $articulo->id_categoria)
									<option value="{{ $cat->id }}" selected>
										{{ $cat->nombre }}
									</option>
								@else
									<option value="{{ $cat->id }}">
										{{ $cat->nombre }}
									</option>
								@endif
							@endforeach
						</select>
					</div>

					<div class="form-group">
						<label for="descripcion">Descripción</label>
						<input type="text" name="descripcion" class="form-control"
						value="{{ $articulo->descripcion }}">
					</div>

					<div class="form-group">
						<label for="imagen">Imágen</label>
						<input type="file" name="imagen">
						@if(($articulo->imagen) != "")
							<img src="{{ asset('imagenes/articulos/'.$articulo->imagen) }}" alt="$articulo->nombre" height="100" width="100">
						@endif
					</div>
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