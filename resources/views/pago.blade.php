@extends('layouts.tienda')

@section('content')
    <div class="py-5 text-center">
        <h2>Checkout</h2>
        <p class="lead">Ingresa los Datos Requeridos para poder seguir con el procesamiento de tu pago</p>
    </div>
    <div class="row">
        <div class="col-md-4 order-md-2 mb-4">
          <h4 class="d-flex justify-content-between align-items-center mb-3">
            <span class="text-muted">Carrito</span>
            <span class="badge badge-secondary badge-pill">{{Session::has('cart') ? Session::get('cart')->totalQty : ''}}</span>
          </h4>
          <ul class="list-group mb-3">
            @foreach ($pago['carro'] as $product)
            <li class="list-group-item d-flex justify-content-between lh-condensed">
              <div>
                <h6 class="my-0">{{ $product['item']['nombre'] }}</h6>
                <small class="text-muted">{{ $product['item']['idproducto'] }}</small>
              </div>
              <div class="text-center">
                <h6 class="my-0"></h6>
                <small class="text-center badge badge-secondary badge-pill">{{ $product['qty'] }}</small>
              </div>
              <span class="text-muted">${{$product['precio']}}</span>
            </li>
            @endforeach
            
            <li class="list-group-item d-flex justify-content-between">
              <span>Total (CLP)</span>
              <strong>${{ $pago['monto'] }}</strong>
            </li>
          </ul>

          
        </div>
        <div class="col-md-8 order-md-1">
          <h4 class="mb-3">Informacion Cliente</h4>
          <form class="needs-validation" method="POST" action="{{ route('orden') }}">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" name="concepto" id="concepto" placeholder="Pago de Orden N° 1000"  value="{{ $pago['descripcion'] }}" readonly="readonly" required>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="rut">RUT</label>
                    <input type="text" name="rut" id="rut" class="form-control" placeholder="11111111-1" value="{{ $pago['rut'] }}" readonly="readonly"  required>
                    <div class="invalid-feedback">
                    Debe ingresar su RUT.
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="pagador">Email <span class="text-muted"></span></label>
                    <input type="email" class="form-control" name="pagador" id="pagador" value="{{ $pago['email'] }}" placeholder="email@ejemplo.cl" required>
                    <div class="invalid-feedback">
                        Por Favor Ingrese un email Valido.
                    </div>
                </div>
            </div>

            <div class="row">
              <div class="col-md-6 mb-3">
                <label for="nombre">Nombre</label>
                <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Nombre" value="" required>
                <div class="invalid-feedback">
                  Debe Ingresar Su nombre.
                </div>
              </div>
              <div class="col-md-6 mb-3">
                <label for="apellido">Apellidos</label>
                <input type="text" class="form-control" name="apellido" id="apellido" placeholder="Apellidos" value="" required>
                <div class="invalid-feedback">
                  Debe ingresar su Apellido.
                </div>
              </div>
            </div>
            
            

            <div class="mb-3">
              <label for="direccion">Dirección</label>
              <input type="text" class="form-control" id="direccion" name="direccion" placeholder="Nombre de Calle" required>
              <div class="invalid-feedback">
                Por favor Ingrese su Dirección.
              </div>
            </div>


            <div class="row">
                <div class="col-md-2 mb-3">
                    <label for="numero">Numero</label>
                    <input type="text" class="form-control" name="numero" id="numero" placeholder="555" value="" required>
                    <div class="invalid-feedback">
                    numero de casa requerido.
                    </div>
                </div>
              <div class="col-md-6 mb-3">
                <label for="ciudad">Ciudad</label>
                <input type="text" class="form-control" name="pais" id="pais" placeholder="Ciudad..." value="" required>
                <div class="invalid-feedback">
                  Please select a valid country.
                </div>
              </div>
              <div class="col-md-4 mb-3">
                <label for="telefono">Telefono</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text">+56 </span>
                    </div>
                    <input type="number" class="form-control" name="telefono" id="telefonno" placeholder="912345678" value="" required>
                    <div class="invalid-feedback" style="width: 100%;">
                        Ingresa un Telefono valido.
                    </div>
                  </div>
              </div>
              
            </div>
            <hr class="mb-4">
            <div class="custom-control custom-checkbox">
              <input type="checkbox" class="custom-control-input" name="seguridad" id="seguridad" required>
              <label class="custom-control-label" for="seguridad">Acepto las politicas de seguridad</label>
            </div>
            <div class="custom-control custom-checkbox">
              <input type="checkbox" class="custom-control-input" name="terminos" id="terminos" required>
              <label class="custom-control-label" for="terminos">Acepto los Terminos de uso y condición</label>
            </div>
            <hr class="mb-4">

            <h4 class="mb-3">Datos para generar orden de pago</h4>
            <div class="row">
              <div class="col-md-6 mb-3">
                <label for="orden">Orden N°</label>
                <input type="text" class="form-control" name="orden" id="orden" placeholder="1000" value="{{ $pago['idventa'] }}" readonly="readonly" required>
                <div class="invalid-feedback">
                  Numero de Orden Requerido.
                </div>
              </div>
              <div class="col-md-6 mb-3">
                <label for="monto">Monto Total Compra</label>
                <input type="text" class="form-control" name="monto" id="monto" placeholder="20000" value="{{ $pago['monto'] }}" readonly="readonly" required>
                <div class="invalid-feedback">
                  Monto total Compra requerido.
                </div>
              </div>
            </div>
        
            <hr class="mb-4">
            <button class="btn btn-primary btn-lg btn-block" type="submit">Ir al Checkout</button>
          </form>
        </div>
      </div>




@endsection