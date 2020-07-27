@extends ('layouts.admin')
@section ('contenido')
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>Listado de Ventas</h3>
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
				</thead>
               @foreach ($venta as $ven)
				<tr>
					<td>{{ $ven->idventa}}</td>
					<td>{{ $ven->total_venta}}</td>
					<td>{{ $ven->fecha}}</td>
					<td>{{ $ven->Persona}}</td>
					<td>
						<a href="{{URL::action('ventasController@edit',$ven->idventa)}}"><button class="btn btn-info">Detalles</button></a>
                         <a href="" data-target="#modal-delete-{{$ven->idventa}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
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
