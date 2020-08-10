<?php

namespace equilibre\Http\Controllers;
use equilibre\Articulo;
use equilibre\Cart;
use Illuminate\Http\Request;

use equilibre\Http\Requests;
use Session;
class ProductsController extends Controller
{
    public function getTienda()
    {
        $products = Articulo::all();
        return view('almacen/tienda/index', ['products' => $products]);
    }

    public  function getAddtocart(Request $request, $id)
    {
        $product = Articulo::find($id);
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->add($product,$product->idproducto);

        $request->session()->put('cart', $cart);
        //dd($request->session()->get('cart'));
        return redirect()->route('almacen.tienda.index');
    }

    public function getRemove($id,$preciototal){
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->remove($id,$preciototal);

        if (count($cart->items) > 0) {
            Session::put('cart', $cart);
        } else {
            Session::forget('cart');
        }


        return redirect()->route('almacen.tienda.carroCompra');
    }


    public function getRemoveAll($id) {
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->removeAll($id);

        if (count($cart->items) > 0) {
            Session::put('cart', $cart);
        } else {
            Session::forget('cart');
        }

        return redirect()->route('almacen.tienda.carroCompra');
    }


    public  function    getCarro()
    {
        if(!Session::has('cart')){
            return view('almacen.tienda.carro-compra');
        }
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
        return view('almacen.tienda.carro-compra',['products' => $cart->items,'preciototal' => $cart->preciototal]);

    }

    public function cliente()
    {
        return view('cliente');
    }
}
