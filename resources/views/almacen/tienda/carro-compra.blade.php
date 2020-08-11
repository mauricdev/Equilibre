@extends('layouts.tienda')

@section('content')
    @if(Session::has('cart'))
    
        <div class="row">
            <div class="col-md mb-3">
                <h4 class="d-flex justify-content-between align-items-center mb-3">
                    <span class="text-muted">Carrito de Compra</span>
                <span class="badge badge-secondary badge-pill">{{Session::has('cart') ? Session::get('cart')->totalQty : ''}}</span>
                </h4>
               
                    <table class="table table-hover" style="font-size: 10px; white-space:nowrap;">
                        <thead>
                          <tr>
                            
                            <th class="text-center " scope="col">Cantidad</th>
                            <th scope="col">Producto</th>
                            <th class="text-right" scope="col">Precio</th>
                            <th scope="col" class="text-center ">Opciones</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $product)
                            <tr>
                                
                                <td class="text-center"><span class="badge badge-info ">{{$product['qty']}}</span></td>
                                <td >
                                    <div>
                                        <h6 class="my-0">{{ $product['item']['nombre'] }}</h6>
                                        <small class="text-muted">{{ $product['item']['idproducto'] }}</small>
                                    </div>
                                </td>
                                <td class="text-right">
                                    <div>
                                        ${{$product['precio']}}
                                    </div>
                                </td>
                                <td class="text-center">
                                    <div class="btn-group">
                                        <input id="btnGroupDrop1" type="button" class="btn btn-danger dropdown-toggle" value="Quitar" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                            <a class="dropdown-item" href="{{ route('almacen.tienda.remover',['id'=> $product['item']['idproducto'],'total'=>$preciototal])}}">Quitar 1</a>
                                            <a class="dropdown-item" href="{{ route('almacen.tienda.removeritem', ['id' => $product['item']['idproducto']]) }}">Quitar Todo</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                            <tr class="table-borderless">
                                <td colspan="2" class="text-right "> <span>Total (CLP)</span></td>
                                <td class="text-right">${{$preciototal}}</td>
                            </tr>
                        </tbody>
                    </table>
                <hr>
                <div class="row">
                    <div class="col-sm-12">
                        <button type="button" class="btn btn-success btn-block" data-toggle="modal" data-target=".bd-example-modal-sm">Ir a Pagar</button>

                    </div>
                </div>
            </div>
            
            <!-- modal -->
            <div class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-sm">
                  <div class="modal-content">
                        <form method="POST" action="{{ route('pago') }}">
                            <div class="modal-header">
                                <h5 class="modal-title text-center" id="exampleModalLabel">Continuar con la compra</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body text-center">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <div class="form-group">
                                    <label class="col-form-label text-center">Ingrese su RUT para Continuar</label>
                                    <input type="text" class="form-control text-center" name="rut" id="rut" placeholder="11111111-1" required>
                                </div>
                            </div>
                            <hr>
                            <div class="text-center">
                                    <button type="button" class="btn btn-danger " data-dismiss="modal">Cancelar</button>
                                        
                                    <button type="submit" class="btn btn-success ">Continuar</button>
                            </div>
                            <br>
                        </form>
                  </div>
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