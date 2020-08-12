@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Editar Usuario: {{ $id }}</h3>
			@if (count($errors)>0)
			<div class="alert alert-danger">
				<ul>
				@foreach ($errors->all() as $error)
					<li>{{$error}}</li>
				@endforeach
				</ul>
			</div>
			@endif

			{!!Form::model($Personas,['method'=>'PATCH','route'=>['almacen.persona.update',$id]])!!}
            {{Form::token()}}
            <div class="form-group">
            	<label for="descripcion">Nombre</label>
            	<input type="text" name="nombre" class="form-control" value="{{$Personas->nombre}}" placeholder="Descripción...">
            </div>
            <div class="form-group">
            	<label for="nombre">Apellidos</label>
            	<input type="text" name="apellidos" class="form-control" value="{{$Personas->apellidos}}" placeholder="Nombre...">
            </div>
            <div class="form-group">
            	<label for="descripcion">Correo</label>
            	<input type="text" name="correo" class="form-control" value="{{$Personas->correo}}" placeholder="Descripción...">
            </div>
            <div class="form-group">
            	<label for="nombre">Dirección</label>
            	<input type="text" name="direccion" class="form-control" value="{{$Personas->direccion}}" placeholder="Nombre...">
            </div>
            <div class="form-group">
            	<label for="descripcion">Ciudad</label>
            	<input type="text" name="ciudad" class="form-control" value="{{$Personas->ciudad}}" placeholder="Descripción...">
            </div>
            <div class="form-group">
            	<label for="nombre">Teléfono</label>
            	<input type="text" name="telefono" class="form-control" value="{{$Personas->telefono}}" placeholder="Nombre...">
            </div>
            <div class="form-group">
            	<button class="btn btn-primary" type="submit">Guardar</button>
            	<button class="btn btn-danger" type="reset">Cancelar</button>
            </div>
			{!!Form::close()!!}		
            
		</div>
	</div>
@endsection