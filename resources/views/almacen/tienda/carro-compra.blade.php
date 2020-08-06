@extends('layouts.tienda')

@section('content')
    @if(Session::has('cart'))
        <div class="row">
            <div class="col-sm col-xs">
                <table class="table table-hover  table-bordered">
                    <thead>
                      <tr>
                        <th class="text-center" scope="col">Cantidad</th>
                        <th scope="col">Producto</th>
                        <th class="text-center" scope="col">Precio</th>
                        <th scope="col">Opciones</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                        <tr>
                            <td class="text-center"><span class="badge badge-info ">{{$product['qty']}}</span></td>
                            <td >{{ $product['item']['nombre'] }}</td>
                            <td class="text-right">{{$product['precio']}}</td>
                            <td>
                                <div class="btn-group">
                                    <button id="btnGroupDrop1" type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Eliminar
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                        <a class="dropdown-item" href="{{ route('almacen.tienda.remover',['id'=> $product['item']['idproducto'],'total'=>$preciototal])}}">Eliminar 1</a>
                                        <a class="dropdown-item" href="{{ route('almacen.tienda.removeritem', ['id' => $product['item']['idproducto']]) }}">Eliminar Todo</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                  </table>
            </div>
            
        </div>
        <div class="row">
            <div class="col-sm"></div>
            <div class="col-sm-4 text-right">
                <strong>Precio Total: $ {{$preciototal}}</strong>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-sm-12">
                <button type="button" class="btn btn-success">Pagar</button>
            </div>
        </div>
    @else
        <div class="row">
            <div class="col-sm text-center">
                <h2>No hay Productos en el Carro de Compra</h2>
            </div>
        </div>
    @endif
@endsection