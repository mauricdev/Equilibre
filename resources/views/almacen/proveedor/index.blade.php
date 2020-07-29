@extends ('layouts.admin')
@section ('contenido')
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>Listado de proveedores <a href="http://localhost:8000/almacen/proveedor/create"><button class="btn btn-success">Nuevo</button></a></h3>
		@include('almacen.proveedor.search')
	</div>
</div>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
				<thead>
					<th>Rut/Id Card</th>
					<th>Razón social</th>
					<th>Dirección</th>
					<th>Ciudad</th>
					<th>Pais</th>
					<th>Telefono</th>
					<th>Correo</th>
					<th>Descripcion</th>
					<th>Opciones</th>
				</thead>
               @foreach ($proveedor as $prov)
				<tr>
					<td>{{ $prov->idproveedor}}</td>
					<td>{{ $prov->razonsocial}}</td>
					<td>{{ $prov->direccion}}</td>
					<td>{{ $prov->ciudad}}</td>
					<td>{{ $prov->pais}}</td>
					<td>{{ $prov->telefono}}</td>
					<td>{{ $prov->correo}}</td>
					<td>{{ $prov->descripcion}}</td>
					<td><a href="{{URL::action('proveedorController@edit',$prov->idproveedor)}}"><button class="btn btn-info">Editar</button></a></td>
                	<td><a href="" data-target="#modal-delete-{{$prov->idproveedor}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a></td>
				</tr>
				@include('almacen.proveedor.modal')
				@endforeach
			</table>
		</div>
		{{$proveedor->render()}}
	</div>
</div>

@endsection
