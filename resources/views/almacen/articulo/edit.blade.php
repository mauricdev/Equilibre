@extends ('layouts.admin')
@section ('contenido')
<div class="row">
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
		<h3>Editar Producto: {{ $articulo->nombre}}</h3>
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
{!!Form::model($articulo,['method'=>'PATCH','route'=>['almacen.articulo.update',$articulo->idproducto],'files'=>'true'])!!}
{{Form::token()}}
<div class="row">
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
		<div class="form-group">
			<label for="nombre">Nombre</label>
			<input type="text" name="nombre" required value="{{$articulo->nombre}}" class="form-control" placeholder="Nombre...">
		</div>
	</div>
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
		<div class="form-group">
			<label for="idproducto">Codigo producto</label>
			<input type="text" name="idproducto" class="form-control" required value="{{$articulo->idproducto}}"  placeholder="Codigo de producto...">
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
			<label for="nombre">unidad_medida</label>
			<input type="text" name="unidad_medida" required value="{{$articulo->unidad_medida}}" class="form-control" placeholder="unidad_medida...">
		</div>
	</div>
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
		<div class="form-group">
			<label for="idproducto">precio_compra</label>
			<input type="text" name="precio_compra" required value="{{$articulo->precio_compra}}" class="form-control" placeholder="precio_compra...">
		</div>
	</div>

	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
		<div class="form-group">
			<label for="nombre">precio_venta</label>
			<input type="text" name="precio_venta" required value="{{$articulo->precio_venta}}" class="form-control" placeholder="precio_venta...">
		</div>
	</div>
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
		<div class="form-group">
			<label for="nombre">Descuento</label>
			<input type="number" name="descuento" required value="{{$articulo->descuento}}" class="form-control"  min="0" max="100" placeholder="descuento...">
		</div>
	</div>
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
		<div class="form-group">
			<label for="nombre">stock</label>
			<input type="text" name="stock" required value="{{$articulo->stock}}" class="form-control" placeholder="stock...">
		</div>
	</div>
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
		<div class="form-group">
			<label for="idproducto">stock_critico</label>
			<input type="text" name="stock_critico" required value="{{$articulo->stock_critico}}" class="form-control" placeholder="stock_critico...">
		</div>
	</div>
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
		<div class="form-group">
			<label for="idproducto">Estado</label>
			<select name="Estado" class="form-control">
				<option value="1">Activo</option>
				<option value="0">Inactivo</option>
			</select>
		</div>
	</div>

	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
		<div class="form-group">
			<label for="idproducto">imagen</label>
			<input type="file" name="imagen" class="form-control">
			@if(($articulo->imagen)!="")
			<img src="{{asset('/imagenes/articulos/'.$articulo->imagen)}}" height="100px" width="100px">
			@endif
		</div>
	</div>
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
		<div class="form-group">
			<button class="btn btn-primary" type="submit">Guardar</button>
			<button type="button" class="btn btn-danger" onclick="window.location='{{url('almacen/articulo')}}'">Cancelar</button>
		</div>
	</div>
	

</div>
{!!Form::close()!!}


@endsection