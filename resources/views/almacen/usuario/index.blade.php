@extends ('layouts.admin')
@section ('contenido')
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>Listado de Usuarios <a href="http://localhost:8000/almacen/usuario/create"><button class="btn btn-success">Nuevo</button></a></h3>
		@include('almacen.usuario.search')
	</div>
</div>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
				<thead>
					<th>Id</th>
					<th>Nombre</th>
					<th>Correo</th>
					<th>Opciones</th>
				</thead>
               @foreach ($usuarios as $user)
				<tr>
					<td>{{ $user->id}}</td>
					<td>{{ $user->name}}</td>
					<td>{{ $user->email}}</td>
					<td>
						<a href="{{URL::action('UsuarioController@edit',$user->id)}}"><button class="btn btn-info">Editar</button></a>
                         <a href="" data-target="#modal-delete-{{$user->id}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
					</td>
				</tr>
				@include('almacen.usuario.modal')
				@endforeach
			</table>
		</div>
		{{$usuarios->render()}}
	</div>
</div>

@endsection
