@extends ('layouts.admin')
@section ('contenido')
<div class="row">
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
		<h3>Añadir Descuento: {{ $articulo->nombre}}</h3>
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
{!!Form::model($articulo,['method'=>'PATCH','route'=>['almacen.articulo.update',$articulo->idproducto],'files'=>'true'])!!}
{{Form::token()}}

<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
		<div class="form-group">
			<label for="idproducto">precio_compra</label>
			<input type="text" name="precio_compra" required value="{{$articulo->precio_compra}}" onchange="sumar(this.value);" class="form-control" placeholder="precio_compra...">
		</div>
	</div>
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
		<div class="form-group">
			<label for="idproducto">Descuento</label>
			<input type="text" name="descuento" required value="0" class="form-control"  placeholder="Descuento...">
		</div>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
		<div class="form-group">
			<label for="idproducto">Precio con descuento</label>
		</div>
    </div>
    <table><form name=p>
<TR>
<TD ALIGN="right"><LABEL FOR='obj2' ACCESSKEY='M'>
<SPAN CLASS='sub'>M</SPAN>onto Pagado:</LABEL></TD>

<TD><INPUT STYLE='text-align:right'ID='obj2' TYPE="text" VALUE=0.00 NAME="monto" ID="monto"></TD></TR>

<TR>
<TD>Tarifa:</TD>
<TD><INPUT STYLE='text-align:right'ID='obj3' TYPE="text" VALUE=0.00 NAME="poretencion"></TD>
</TR>

<TR>
<TD>Monto Retenido:</TD>
<TD><INPUT STYLE='text-align:right' ID='obj5' TYPE="text" NAME="montoretenido" VALUE="0.00">
</TD>
</TR>
<tr>
<td><input type=button value="Calcular" onClick="prod()"></td></tr>
</form>
</table>
{!!Form::close()!!}
<script>
 function multiplica(form){
 var resultado;
 var resultado2;
 var x=0;
 var y=0;
 x = parseInt (form.monto_trasferido.value);
 y = parseInt (form.id_porcentaje.value);

 resultado = x * y/100;
 form.ganancia.value=resultado;


  resultado2 = x + y;
  form.total.value=resultado2;

   }
</script>
@endsection