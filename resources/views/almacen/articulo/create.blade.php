@extends ('layouts.admin')
@section ('contenido')
<div class="row">
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
		<h3>Nuevo Articulo</h3>
		@if (count($errors)>0)
		<div class="alert alert-danger">
			<ul>
				@foreach ($errors->all() as $error)
				<li>{{$error}}</li>
				@endforeach
			</ul>
		</div>
		@endif
	</div>
</div>
{!!Form::open(array('url'=>'almacen/articulo','method'=>'POST','autocomplete'=>'off','files'=>'true'))!!}
{{Form::token()}}

<div class="row">
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
		<div class="form-group">
			<label for="nombre">Nombre</label>
			<input type="text" name="nombre" required value="{{old('nombre')}}" class="form-control" placeholder="Nombre...">
		</div>
	</div>
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
		<div class="form-group">
			<label for="idproducto">Codigo Producto</label>
			<input type="text" name="idproducto" class="form-control" placeholder="Codigo de producto...">
		</div>
	</div>
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
		<div class="form-group">
			<label>Categorias</label>
			<select name="categoria_idcategoria" class="form-control">
				@foreach($categorias as $cat)
				<option value="{{$cat->idcategoria}}">{{$cat->nombre}}</option>
				@endforeach
			</select>
		</div>
	</div>
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
		<div class="form-group">
			<label for="nombre">Unidad de Medida</label>
			<input type="text" name="unidad_medida" required value="{{old('unidad_medida')}}" class="form-control" placeholder="unidad medida...">
		</div>
	</div>
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
		<div class="form-group">
			<label for="idproducto">Precio de Compra</label>
			<input type="text" name="precio_compra" class="form-control" placeholder="precio compra...">
		</div>
	</div>

	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
		<div class="form-group">
			<label for="nombre">Precio de Venta</label>
			<input type="text" name="precio_venta" required value="{{old('precio_venta')}}" class="form-control" placeholder="precio venta...">
		</div>
	</div>
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
		<div class="form-group">
			<label for="nombre">Descuento</label>
			<input type="text" name="descuento" required value="{{old('descuento')}}" class="form-control" placeholder="precio venta...">
		</div>
	</div>

	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
		<div class="form-group">
			<label for="nombre">Stock</label>
			<input type="text" name="stock" required value="{{old('stock')}}" class="form-control" placeholder="stock...">
		</div>
	</div>
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
		<div class="form-group">
			<label for="idproducto">Stock critico</label>
			<input type="text" name="stock_critico" class="form-control" placeholder="stock_critico...">
		</div>
	</div>
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
		<div class="form-group">
			<label for="idproducto">Imagen</label>
			<input type="file" name="imagen" class="form-control">
		</div>
	</div>
</div>



<div class="form-group">
	<button class="btn btn-primary" type="submit">Guardar</button>
	<button class="btn btn-danger" type="reset">Cancelar</button>
</div>

{!!Form::close()!!}

</div>
</div>
@endsection