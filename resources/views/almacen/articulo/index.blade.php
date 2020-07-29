@extends ('layouts.admin')
@section ('contenido')
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>Listado de Articulo <a href="http://localhost:8000/almacen/articulo/create"><button class="btn btn-success">Nuevo</button></a></h3>
		@include('almacen.articulo.search')
	</div>
</div>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
				<thead>
					<th>Codigo</th>
					<th>Nombre</th>
					<th>Categoria</th>
					<th>Medida</th>
					<th>Precio compra</th>
					<th>Precio venta</th>
					<th>Stock</th>
					<th>Stock_critico</th>
					<th>Estado</th>
					<th>Imagen</th>
					<th>Opciones</th>
				</thead>
               @foreach ($articulos as $art)
				<tr>
					<td>{{ $art->idproducto}}</td>
					<td>{{ $art->nombre}}</td>
					<td>{{ $art->categoria}}</td>
					<td>{{ $art->unidad_medida}}</td>
					<td>{{ $art->precio_compra}}</td>
					<td>{{ $art->precio_venta}}</td>
					@if($art->stock <= $art->stock_critico )
					<td style="color:red;">{{ $art->stock}}</td>
					@else
					<td >{{ $art->stock}}</td>			
					@endif
					<td >{{ $art->stock_critico}}</td>
					<td>{{ $art->Estado}}</td>
					<td>
						<img src="{{asset('/imagenes/articulos/'.$art->imagen)}}" alt="{{$art->nombre}}" height="80px" width="80px" class="img-thumbnail">
					</td>
					<td>
						 <a href="{{URL::action('ArticuloController@edit',$art->idproducto)}}"><button class="btn btn-info">Editar</button></a>
						 <a href="" data-target="#modal-delete-{{$art->idproducto}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>						
					</td>
				</tr>
				@include('almacen.articulo.modal')
				@endforeach
			</table>
		</div>
		{{$articulos->render()}}
	</div>
</div>

@endsection
