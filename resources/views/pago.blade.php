@extends('layouts.tienda')

@section('content')
    <form method="POST" action="{{ route('orden') }}">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        Orden N°: <input type="text" name="orden" id="orden" placeholder="1000" value="{{ $pago['idventa'] }}" readonly="readonly" required><br>
        Monto: <input type="text" name="monto" id="monto" placeholder="20000" value="{{ $pago['monto'] }}" readonly="readonly" required><br>
        Descripción: <input type="text" name="concepto" id="concepto" placeholder="Pago de Orden N° 1000"  value="{{ $pago['descripcion'] }}" readonly="readonly" required><br>
        Email pagador: <input type="email" name="pagador" id="pagador" placeholder="usuario@email.com" value="{{ $pago['email'] }}"  required><br>
        rut: <input type="text" name="rut" id="rut" placeholder="11111111-1" value="{{ $pago['rut'] }}" readonly="readonly"  required><br>
       <br>
        <button type="submit">Aceptar</button>
    </form>
@endsection