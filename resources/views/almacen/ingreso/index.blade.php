@extends ('layouts.admin')
@section ('contenido')
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>Listado de Ingresos   <a href="ingreso/create"><button class="btn btn-success"> Nuevo</button></a></h3>
		@include('almacen.ingreso.search')
	</div>
</div>
<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
				<thead>
					<th>ID</th>
					<th>Fecha</th>
					<th>Comprobante</th>
					<th>Provedor</th>
					<th>Razon social</th>
					<th>Total</th>
					<th>Opciones</th>
				</thead>
               @foreach ($ingresos as  $prov)
				<tr>
					<td>{{ $prov->id}}</td>
					<td>{{ date('Y-m-d-H:i:s',strtotime($prov->fechaHora))}}</td>
					<td>{{ $prov->tipoComprobante.' :  ' .$prov->numeroComprobante}}</td>
					<td>{{ $prov->proveedor_idproveedor}}</td>
					<td>{{ $prov->razonsocial}}</td>
					<td>{{ $prov->total}}</td>
					<td><a href="{{URL::action('ingresoController@show',$prov->id)}}"><button class="btn btn-success">Detalles</button></a>
                	<a href="" data-target="#modal-delete-{{$prov->id}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a></td>
				</tr>
				@include('almacen.ingreso.modal')
				@endforeach
			</table>
		</div>
		{{$ingresos->render()}}
	</div>
</div>

@endsection
