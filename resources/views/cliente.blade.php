@extends('layouts.tienda')

@section('content')
    <form method="POST" action="{{ route('pago') }}">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <br>
        INGRESE SU RUT PARA Continuar
        <br>
        RUT: <input type="text" name="rut" id="rut" placeholder="11111111-1" required><br>
        
        <br>
        <button type="submit">Continuar</button>
    </form>
@endsection