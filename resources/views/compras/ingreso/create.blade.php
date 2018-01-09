@extends('layouts.admin')

@section('header')
	<h1>
		Nuevo Ingreso
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
			
			<form action="/compras/ingreso" method="POST">
				<input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
				
				<div class="row">
				<div class="col-md-3">
					<div class="form-group">
						<label for="proveedor">Proveedor</label>
						<select name="id_proveedor" id="id_proveedor" class="form-control selectpicker" data-live-search="true">
							@foreach($personas as $per)
							<option value="{{ $per->id }}">
								{{ $per->nombre }}
							</option>
							@endforeach
						</select>
					</div>
				</div><!-- fin col-md-3 -->
				<div class="col-md-3">
					<div class="form-group">
						<label for="tipo_comprobante">Tipo de Comprobante</label>
						<select name="tipo_comprobante" class="form-control">
							<option value="Factura">Factura</option>
							<option value="Ticket">Ticket</option>
						</select> 
					</div>
				</div><!-- fin col-md-3 -->
				<div class="col-md-3">
					<div class="form-group">
						<label for="serie_comprobante">Serie Comprobante</label>
						<input type="text" name="serie_comprobante" class="form-control" placeholder="Serie Comprobante" value="{{ old('serie_comprobante') }}">
					</div>
				</div><!-- fin col-md-3 -->
				<div class="col-md-3">
					<div class="form-group">
						<label for="num_comprobante">Número Comprobante</label>
						<input type="text" name="num_comprobante" class="form-control" placeholder="Número Comprobante" value="{{ old('num_comprobante') }}" required>
					</div>
				</div><!-- fin col-md-3 -->
				</div><!-- fin row cabecera -->

				<div class="row">
					<div class="panel panel-body panel-primary">
						<div class="col-md-4">
							<div class="form-group">
								<label for="articulo">Artículo</label>
							<select name="pid_articulo" id="pid_articulo" class="form-control selectpicker" data-live-search="true">
									@foreach($articulos as $art)
									<option value="{{ $art->id }}">
										{{ $art->articulo }}
									</option>
									@endforeach
							</select>
							</div>
						</div>
						<div class="col-md-2">
							<div class="form-group">
								<label for="pcantidad">Cantidad</label>
								<input type="number" name="pcantidad" id="pcantidad" class="form-control" placeholder="Cantidad">
							</div>
						</div>
						<div class="col-md-2">
							<div class="form-group">
								<label for="pprecio_compra">Precio Compra</label>
								<input type="number" name="pprecio_compra" id="pprecio_compra" class="form-control" placeholder="Precio Compra">
							</div>
						</div>
						<div class="col-md-2">
							<div class="form-group">
								<label for="pprecio_venta">Precio venta</label>
								<input type="number" name="pprecio_venta" id="pprecio_venta" class="form-control" placeholder="Precio Venta">
							</div>
						</div>
						<div class="col-md-2">
							<div class="form-group">
								<button type="button" id="bt_add" class="btn btn-primary">
									Agregar
								</button>
							</div>
						</div>
						
						<div class="col-md-12">
							<table id="detalles" class="table table-striped table-bordered table-hover table-condensed" style="margin-top: 10px">
								<thead style="background-color: #A9D0F5">
									<th>Opciones</th>
									<th>Artículo</th>
									<th>Cantidad</th>
									<th>Precio Compra</th>
									<th>Precio Venta</th>
									<th>Subtotal</th>
								</thead>
								<tfoot>
									<th>Total</th>
									<th></th>
									<th></th>
									<th></th>
									<th></th>
									<th><h4 id="total">0.00</h4></th>
								</tfoot>
								<tbody>
									
								</tbody>
							</table>
						</div>

					</div><!-- panel-body -->
				</div><!-- fin row detalle -->
				
				<div class="row">
				<div class="col-md-12" id="guardar">
					<div class="form-group">
						<button class="btn btn-primary" type="submit">
							Guardar
						</button>
					</div>
				</div>
				</div><!-- fin row buttons -->
			</form>

		</div>
	</div>

@push('scripts')
<script>
	
	$(document).ready(function(){
		$("#bt_add").click(function(){
			agregar();
		});
	});

	var cont = 0;
	var total = 0;
	var subtotal = [];

	//Cuando cargue el documento
	//Ocultar el botón Guardar
	$("#guardar").hide();

	function agregar(){
		//Obtener los valores de los inputs
		id_articulo = $("#pid_articulo").val();
		articulo = $("#pid_articulo option:selected").text();
		cantidad = $("#pcantidad").val();
		precio_compra = $("#pprecio_compra").val();
		precio_venta = $("#pprecio_venta").val();

		//Validar los campos
		if(id_articulo != "" && cantidad > 0 && precio_compra != "" && precio_venta != ""){

			//subtotal array inicie en el indice cero
			subtotal[cont] = (cantidad * precio_compra);
			total = total + subtotal[cont];

			var fila = '<tr class="selected" id="fila'+cont+'"><td><button type="button" class="btn btn-warning" onclick="eliminar('+cont+')">X</button></td><td><input type="hidden" name="id_articulo[]" value="'+id_articulo+'">'+articulo+'</td><td><input type="number" name="cantidad[]" value="'+cantidad+'"></td><td><input type="number" name="precio_compra[]" value="'+precio_compra+'"></td><td><input type="number" name="precio_venta[]" value="'+precio_venta+'"></td><td>'+subtotal[cont]+'</td></tr>';

			cont++;
			limpiar();
			$("#total").html("$" + total);
			evaluar();
			$("#detalles").append(fila);
		}else{
			alert("Error al ingresar el detalle del ingreso, revise los datos del artículo");
		}
	}

	function limpiar(){
		$("#pcantidad").val("");
		$("#pprecio_compra").val("");
		$("#pprecio_venta").val("");
	}

	//Muestra botón guardar
	function evaluar(){
		if(total > 0){
			$("#guardar").show();
		}else{
			$("#guardar").hide();
		}
	}

	function eliminar(index){
		total = total-subtotal[index];
		$("#total").html("$" + total);
		$("#fila" + index).remove();
		evaluar();
	}

</script>
@endpush
@endsection