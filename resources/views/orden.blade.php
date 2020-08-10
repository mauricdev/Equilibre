@extends('layouts.tienda')

@section('content')
    <!-- Formulario HTML que envía la nueva Orden -->
    Confirme su orden antes de proceder al pago via Flow<br>
    <br>
    Orden N°: {{ $order['commerceOrder'] }}<br>
    Orden FLOW N°: {{ $order['response']->flowOrder }} <br>
    Monto: {{ $order['amount'] }}<br>
    Descripción: {{ $order['subject'] }}<br>
    Email pagador (opcional): {{ $order['email'] }}<br>
    <br>
    <form method="POST" action="https://sandbox.flow.cl/app/web/pay.php">

        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="token" value="{{ $order['response']->token }}">
        <button type="submit">Pagar en Flow</button>
    </form>
@endsection
