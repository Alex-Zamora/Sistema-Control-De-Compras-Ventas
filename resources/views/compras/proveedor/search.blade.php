<form action="/compras/proveedor" method="GET">
	<div class="form-group">
		<div class="input-group">
			<input type="text" name="searchText" class="form-control" placeholder="Buscar..." value="{{ $searchText }}">
			<span class="input-group-btn">
				<button type="submit" class="btn btn-primary">Buscar</button>
			</span>
		</div>
	</div>
</form>