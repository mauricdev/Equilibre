@extends ('layouts.admin')
@section ('contenido')

<div class="row">
	<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
		<div class="form-group">
			<label for="nombre">ID de Venta</label>
			<p>{{$venta->idventa}}</p>
		</div>
	</div>
	<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
		<div class="form-group">
			<label for="nombre">Fecha</label>
			<p>{{date('Y-m-d H:i:s',strtotime($venta->fechaHora))}}</p>
		</div>
	</div>
	<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
		<div class="form-group">
			<label for="nombre">Rut Cliente</label>
			<p>{{$venta->persona_rut1}}</p>
		</div>
	</div>
</div>
<div class="row">
	<div class="panel panel-primary">
		<div class="panel-body">

			<table class="table table-striped table-bordered table-condensed table-hover">
				<thead style="background-color: #A9D0F5;">
					<th>Nombre Cliente</th>
					<th>Codigo Producto</th>
					<th>Producto</th>
					<th>Cantidad</th>
					<th>Precio Unitario</th>
					<th>Subtotal</th>
				</thead>
				<tfoot>
					<th></th>
					<th></th>
					<th></th>
					<th></th>
					<th></th>
					<th>
						<h4 id="total">${{$venta->total_venta}}</h4>

					</th>
				</tfoot>
				<tbody>
					@foreach ($detalle as $det)
					<tr>
						<td>{{ $det->nombre. $det->apellidos}}</td>
						<td>{{ $det->producto_idproducto}}</td>
						<td>{{ $det->producto}}</td>
						<td>{{ $det->cantidad}}</td>
						<td>{{ $det->precio_unitario}}</td>
						<td>{{ $det->precio_total}}</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>

</div>

@endsection