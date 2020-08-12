@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <h3>Editar Proveedor: {{ $id }}</h3>
            
            @if (count($errors)>0)
            
			<div class="alert alert-danger">
				<ul>
                @foreach ($errors->all() as $error)
                
					<li>{{$error}}</li>
                @endforeach
                
				</ul>
            </div>
            
            @endif
            
			{!!Form::model($proveedor,['method'=>'PATCH','route'=>['almacen.proveedor.update',$id]])!!}
            {{Form::token()}}

            	<input type="hidden" name="idproveedor" value="{{$id}}" >
            <div class="form-group">
            	<label for="nombre">Razón Social</label>
            	<input type="text" name="razonsocial" value="{{$proveedor->razonsocial}}" class="form-control" placeholder="razonsocial...">
            </div>
            <div class="form-group">
            	<label for="descripcion">Dirección</label>
            	<input type="text" name="direccion" value="{{$proveedor->direccion}}" class="form-control" placeholder="direccion...">
			</div>
			<div class="form-group">
            	<label for="descripcion">Ciudad</label>
            	<input type="text" name="ciudad" value="{{$proveedor->ciudad}}" class="form-control" placeholder="ciudad...">
			</div>
			<div class="form-group">
            	<label for="descripcion">Pais</label>
            	<input type="text" name="pais" value="{{$proveedor->pais}}" class="form-control" placeholder="pais...">
			</div>
			<div class="form-group">
            	<label for="descripcion">Telefono</label>
            	<input type="text" name="telefono" value="{{$proveedor->telefono}}" class="form-control" placeholder="telefono...">
			</div>
			<div class="form-group">
            	<label for="descripcion">Correo</label>
            	<input type="text" name="correo" value="{{$proveedor->correo}}" class="form-control" placeholder="correo...">
			</div>
			<div class="form-group">
            	<label for="descripcion">Descripción</label>
            	<input type="text" name="descripcion" value="{{$proveedor->descripcion}}" class="form-control" placeholder="descripcion...">
            </div>
            <div class="form-group">
            	<button class="btn btn-primary" type="submit">Guardar</button>
            	<button class="btn btn-danger" type="reset">Cancelar</button>
            </div>

            {!!Form::close()!!}		
                        
		</div>
	</div>
@endsection