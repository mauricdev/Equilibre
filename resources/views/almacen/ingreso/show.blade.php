@extends ('layouts.admin')
@section ('contenido')


<div class="row">
	<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
		<div class="form-group">
			<label for="nombre">Proveedor</label>
			<p>{{$ingreso->proveedor}}</p>
		</div>
	</div>
	<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
		<div class="form-group">
			<label for="nombre">Tipo de comprobante</label>
			<p>{{$ingreso->tipoComprobante}}</p>
		</div>
	</div>
	<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
		<div class="form-group">
			<label for="nombre">Numero de Comprobante</label>
			<p>{{$ingreso->numeroComprobante}}</p>
		</div>
	</div>
</div>
<div class="row">
	<div class="panel panel-primary">
		<div class="panel-body">
			
					<table  class="table table-striped table-bordered table-condensed table-hover">
						<thead style="background-color: #A9D0F5;">
							<th>Productos</th>
							<th>Cantidad</th>
							<th>Precio Compra</th>
							<th>Subtotal</th>
						</thead>
						<tfoot>
							<th></th>
							<th></th>
							<th></th>
							<th>
								<h4 id="total">${{$ingreso->total}}</h4>
								
							</th>
						</tfoot>
						<tbody>
							@foreach($detalle as $det)
							
							<tr>
								<td>{{$det->producto}}</td>
								<td>{{$det->cantidad}}</td>
								<td>${{$det->precio_compra}}</td>
								<td>${{$det->cantidad*$det->precio_compra}}</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
	</div>

</div>

@endsection