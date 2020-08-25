@extends('layouts.tienda')

@section('content')
    <div class="py-5 text-center">
        <h2>Confirmacion de Orden</h2>
        <p class="lead">Confirme su orden antes de proceder al pago via Flow</p>
    </div>
    <!-- Formulario HTML que envía la nueva Orden -->
    <div class="row">
        <dic class="col-md-4"></dic>
        <div class="col-md-4">
            <div class="row">
                <div class="col-md-12 mb-3">
                    <label for="rut">Orden Venta N°: {{ $order['commerceOrder'] }}</label>
                    <br>
                    <label for="rut">Orden FloW N°: {{ $order['response']->flowOrder }}</label>
                    <br>
                    <label for="rut">Monto: ${{ $order['amount'] }} CLP</label>
                    <br>
                    <label for="rut">Descripción: {{ $order['subject'] }}</label>
                    <br>
                    <label for="rut">RUT Cliente: {{ $order['opcionales']->Rut}}</label>
                    <br>
                    <label for="rut">Email Cliente: {{ $order['email'] }}</label>
                </div>
                <div class="col-md-12 mb-3">
                    <form method="POST" action="https://sandbox.flow.cl/app/web/pay.php">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="token" value="{{ $order['response']->token }}">
                        <button type="submit" class="btn btn-primary btn-block">Pagar en Flow</button>
                    </form>
                </div>
                
            </div>
        </div>
        <div class="col-md-4"></div>
    </div>
    
@endsection
