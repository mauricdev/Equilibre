@extends ('layouts.admin')
@section ('contenido')
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>Listado de Personas</h3>
		@include('almacen.persona.search')
	</div>
</div>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
				<thead>
					<th>Rut</th>
					<th>Nombre</th>
					<th>Apellidos</th>
					<th>Correo</th>
					<th>Dirección</th>
					<th>Ciudad</th>
					<th>Teléfono</th>
					<th>Opciones</th>
				</thead>
               @foreach ($personas as $per)
				<tr>
					<td>{{ $per->rut}}</td>
					<td>{{ $per->nombre}}</td>
					<td>{{ $per->apellidos}}</td>
					<td>{{ $per->correo}}</td>
					<td>{{ $per->direccion}}</td>
					<td>{{ $per->ciudad}}</td>
					<td>{{ $per->telefono}}</td>
					<td>
						<a href="{{URL::action('personaController@edit',$per->rut)}}"><button class="btn btn-info">Editar</button></a>
					</td>
				</tr>
				@endforeach
			</table>
		</div>
		{{$personas->render()}}
	</div>
</div>

@endsection
