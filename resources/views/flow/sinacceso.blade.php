@extends('layouts.tienda')

@section('content')
    <h1>Error</h1>
    Usted No tiene pagos Pendientes<br>
    <br>
    <br>
    <a href="{{ url('/tienda') }}">Ir a la tienda</a>
@endsection