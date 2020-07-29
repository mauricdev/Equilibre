@extends ('layouts.admin')
@section ('contenido')
<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<h3>Detalle de la venta</h3>
		@if (count($errors)>0)
		<div class="alert alert-danger">
			<ul>
				@foreach ($errors->all() as $error)
				<li>{{$error}}</li>
				@endforeach
			</ul>
		</div>
		@endif
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="table-responsive">
					<table class="table table-striped table-bordered table-condensed table-hover">
						<thead>
							<th>Id venta </th>
							<th>Rut</th>
							<th>Nombre</th>
							<th>Codigo Producto</th>
							<th>Producto</th>
							<th>Cantidad</th>
							<th>Precio Unitario</th>
							<th>Precio Total</th>
						</thead>
						@foreach ($detalle as $det)
						<tr>
							<td>{{ $det->venta_idventa}}</td>
							<td>{{ $det->persona}}</td>
							<td>{{ $det->nombre}}</td>
							<td>{{ $det->producto_idproducto}}</td>
							<td>{{ $det->producto}}</td>
							<td>{{ $det->cantidad}}</td>
							<td>{{ $det->precio_unitario}}</td>
							<td>{{ $det->precio_total}}</td>
						</tr>
						@endforeach
					</table>
				</div>
				{{$detalle->render()}}
			</div>
		</div>
<div class="col-4">
<a href="{{URL::action('ventasController@index')}}"><button class="btn btn-success">Volver</button></a>
</div>
	</div>
</div>
@endsection