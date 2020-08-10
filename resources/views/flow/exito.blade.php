@extends('layouts.tienda')

@section('content')
    <h1>Página de éxito de Comercio</h1>
    Su pago se ha realizado exitosamente<br>
    <br>
    Orden de Compra: {{ $FlowOrder['n_orden'] }}<br>
    <br>
    Gracias por su compra

    <a href="{{ url('/tienda') }}">Volver a la tienda</a>
@endsection
