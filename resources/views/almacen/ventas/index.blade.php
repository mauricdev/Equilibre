@extends ('layouts.admin')
@section ('contenido')
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>Listado de Ventas <a href="/exportarVenta"><button class="btn btn-success">Reporte</button></a></h3>
		@include('almacen.ventas.search')
	</div>
</div>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
				<thead>
					<th>Id</th>
					<th>Total venta</th>
					<th>Fecha</th>
					<th>Persona</th>
					<th>Estado</th>
				</thead>
               @foreach ($venta as $ven)
				<tr>
					<td>{{ $ven->idventa}}</td>
					<td>{{ $ven->total_venta}}</td>					
					<td>{{ date('Y-m-d H:i:s',strtotime($ven->fechaHora))}}</td>
					<td>{{ $ven->Persona}}</td>
					@if($ven->estado == 1)
					<td>Activo</td>
					@else
					<td>Anulado</td>
					@endif
					<td>
						<a href="{{URL::action('ventasController@edit',$ven->idventa)}}"><button class="btn btn-info">Detalles</button></a>
					@if($ven->estado == 1)
					<a href="" data-target="#modal-delete-{{$ven->idventa}}" data-toggle="modal"><button class="btn btn-danger">Anular</button></a>
					@else
					<a href="" data-target="#modal-delete-{{$ven->idventa}}" data-toggle="modal"><button class="btn btn-success">Activar</button></a>
					@endif
					</td>
				</tr>
				@include('almacen.ventas.modal')
				@endforeach
			</table>
		</div>
		{{$venta->render()}}
	</div>
</div>

@endsection
