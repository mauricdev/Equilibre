@extends ('layouts.admin')
@section ('contenido')
<div class="row">
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
		<h3>Nuevo Ingreso</h3>
		@if (count($errors)>0)
		<div class="alert alert-danger">
			<ul>
				@foreach ($errors->all() as $error)
				<li>{{$error}}</li>
				@endforeach
			</ul>
		</div>
		@endif
	</div>
</div>

{!!Form::open(array('url'=>'almacen/ingreso','method'=>'POST','autocomplete'=>'off'))!!}
{{Form::token()}}
<div class="row">
	<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
		<div class="form-group">
			<label for="nombre">Proveedor</label>
			<select name="proveedor_idproveedor" id="proveedor_idproveedor" class="form-control selectpicker" data-live-search="true">
				@foreach($personas as $per)
				<option value="{{$per->idproveedor}}">{{$per->razonsocial}}</option>
				@endforeach
			</select>
		</div>
	</div>
	<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
		<div class="form-group">
			<label for="nombre">Tipo de comprobante</label>
			<select name="tipoComprobante" id="tipoComprobante" class="form-control">
				<option value="Boleta">Boleta</option>
				<option value="Factura">Factura</option>
			</select>
		</div>
	</div>
	<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
		<div class="form-group">
			<label for="nombre">Numero de Comprobante</label>
			<input type="text" id="numeroComprobante" name="numeroComprobante" value="{{old('numeroComprobante')}}" class="form-control" placeholder="Numero de Documento...">
		</div>
	</div>
</div>

<div class="row">
	<div class="panel panel-primary">
		<div class="panel-body">
			<div class="col-lg-3 col-sm-3 col-md-3 col-xs-3">
				<div class="form-group">
					<label for="nombre">Producto</label>
					<select name="pidarticulo" class="form-control selectpicker" id="pidarticulo" data-live-search="true">
						@foreach($articulos as $art)
						<option value="{{$art->idproducto}}">{{$art->articulo}}</option>
						@endforeach
					</select>
				</div>
			</div>
			<div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">
				<div class="form-group">
					<label for="nombre">Cantidad</label>
					<input type="number" name="cantidad" id="cantidad" value="{{old('cantidad')}}" class="form-control" placeholder="Cantidad...">
				</div>
			</div>
			<div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">
				<div class="form-group">
					<label for="nombre">Precio de compra</label>
					<input type="number" name="precio_compra" id="precio_compra" value="{{old('precio_compra')}}" class="form-control" placeholder="Precio De Compra...">
				</div>
			</div>
			<div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">
				<div class="form-group">
					<button type="button" id="bt_add" class="btn btn-primary">Agregar</button>
				</div>
			</div>
			<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
				<div class="form-group">
					<table id="detalle" class="table table-striped table-bordered table-condensed table-hover">
						<thead style="background-color: #A9D0F5;">
							<th>Opciones</th>
							<th>Productos</th>
							<th>Cantidad</th>
							<th>Precio Compra</th>
							<th>Subtotal</th>
						</thead>
						<tfoot>
							<th>Total</th>
							<th></th>
							<th></th>
							<th></th>
							<th>
								<h4 id="total">$/ 0.0</h4>
							</th>
						</tfoot>
						<tbody>

						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	
</div>
<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12" id="guardar">
		<div class="form-group">
			<input name="_token" value="{{ csrf_token() }}" type="hidden"></input>
			<button class="btn btn-primary" type="submit">Guardar</button>
			<button class="btn btn-danger" type="reset">Cancelar</button>
		</div>
	</div>
</div>

</div>

{!!Form::close()!!}
@push ('scripts')
<script>
	$(document).ready(function() {
		$('#bt_add').click(function() {
			agregar();
		});
	});

	var cont = 0;
	total = 0;
	subtotal = [];
	$("#guardar").hide();

	function agregar() {
		pidarticulo = $("#pidarticulo").val();
		articulo = $("#pidarticulo option:selected").text();
		cantidad = $("#cantidad").val();
		precio_compra = $("#precio_compra").val();

		if (pidarticulo != "" && cantidad != "" && cantidad > 0 && precio_compra != "") {
			subtotal[cont] = (cantidad * precio_compra);
			total = total + subtotal[cont];

			var fila = '<tr class="selected" id="fila' + cont + '"><td><button type="button" class="btn btn-warning" onclick="eliminar(' + cont + ');">X</button></td><td><input type="hidden" name="pidarticulo[]" value="' + pidarticulo + '">' + articulo + '</td><td><input type="number" name="cantidad[]" value="' + cantidad + '"></td><td><input type="number" name="precio_compra[]" value="' + precio_compra + '"></td><td>' + subtotal[cont] + '</td></tr>';
			cont++;
			limpiar();
			$("#total").html("$/" + total);
			evaluar();
			$('#detalle').append(fila);
		} else {
			alert("Error al ingresar el detalle del ingreso");
		}
	}

	function limpiar() {
		$("#cantidad").val("");
		$("#precio_compra").val("");
	}

	function evaluar() {
		if (total > 0) {
			$("#guardar").show();
		} else {
			$("#guardar").hide();
		}
	}

	function eliminar(index) {
		total = total - subtotal[index];
		$("#total").html("$/. " + total);
		$("#fila" + index).remove("#fila" + index);
		evaluar();
	}
</script>
@endpush
@endsection