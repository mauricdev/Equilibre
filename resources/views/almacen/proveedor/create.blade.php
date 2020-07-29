@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Nuevo Proveedor</h3>
			@if (count($errors)>0)
			<div class="alert alert-danger">
				<ul>
				@foreach ($errors->all() as $error)
					<li>{{$error}}</li>
				@endforeach
				</ul>
			</div>
			@endif

			{!!Form::open(array('url'=>'almacen/proveedor','method'=>'POST','autocomplete'=>'off'))!!}
			{{Form::token()}}
			<div class="form-group">
            	<label for="nombre">Rut o id</label>
            	<input type="text" name="idproveedor" class="form-control" placeholder="Rut o id...">
            </div>
            <div class="form-group">
            	<label for="nombre">Razón Social</label>
            	<input type="text" name="razonsocial" class="form-control" placeholder="razonsocial...">
            </div>
            <div class="form-group">
            	<label for="descripcion">Direcci+on</label>
            	<input type="text" name="direccion" class="form-control" placeholder="direccion...">
			</div>
			<div class="form-group">
            	<label for="descripcion">Ciudad</label>
            	<input type="text" name="ciudad" class="form-control" placeholder="ciudad...">
			</div>
			<div class="form-group">
            	<label for="descripcion">Pais</label>
            	<input type="text" name="pais" class="form-control" placeholder="pais...">
			</div>
			<div class="form-group">
            	<label for="descripcion">Telefono</label>
            	<input type="text" name="telefono" class="form-control" placeholder="telefono...">
			</div>
			<div class="form-group">
            	<label for="descripcion">Correo</label>
            	<input type="text" name="correo" class="form-control" placeholder="correo...">
			</div>
			<div class="form-group">
            	<label for="descripcion">Descripción</label>
            	<input type="text" name="descripcion" class="form-control" placeholder="descripcion...">
            </div>
            <div class="form-group">
            	<button class="btn btn-primary" type="submit">Guardar</button>
            	<button class="btn btn-danger" type="reset">Cancelar</button>
            </div>

			{!!Form::close()!!}		
            
		</div>
	</div>
@endsection