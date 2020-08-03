@extends('layouts.tienda')

@section('content')

@foreach ($products->chunk(3) as $productChunk)
<div class="row">
    @foreach($productChunk as $product)
    <div class="col-sm-6 col-md-4">
        <div class="card" >
            <img class="card-img-top" src="{{asset('/imagenes/articulos/'.$product->imagen)}}" alt="{{$product->nombre}}" height="350px">
            <div class="card-body">
            <h5 class="card-title">{{$product->nombre}}</h5>
            
            <p class="card-text">Stock: {{$product->stock}} {{$product->unidad_medida}}</p>
            <p class="card-text">Descuento: ${{$product->descuento}}CLP</p>
            <p class="card-text">Codigo: {{$product->idproducto}}</p>
            <div class="row">
                <div class="col-sm-6 text-left">
                    ${{$product->precio_venta - $product->descuento}} CLP
                </div>
                <div class="col-sm-6 text-right">
                <a href="{{ route('almacen.tienda.addToCart',['id' => $product->idproducto])}}" class="btn btn-success" role="button">Añadir al Carro</a>
                </div>
                
            </div>
            
            </div>
        </div>
    </div>

    @endforeach
    
</div>
@endforeach



@endsection