<div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom box-shadow">
    <h5 class="my-0 mr-md-auto font-weight-normal">Equilibre</h5>
    <nav class="my-2 my-md-0 mr-md-3">
      <a class="p-2 text-dark" href="{{url('/')}}">Inicio</a>
      <a class="p-2 text-dark" href="{{url('/tienda')}}">Tienda</a>
      <a class="p-2 text-dark" href="{{route('almacen.tienda.carroCompra')}}">
        <i class="fas fa-shopping-cart"></i> Carrito de Compra
        <span class="badge badge-secondary">{{ Session::has('cart') ? Session::get('cart')->totalQty : ''}}</span>
      </a>
    </nav>
    <a class="btn btn-outline-primary" href="#">Contacto</a>
</div>