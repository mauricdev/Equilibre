<?php

namespace equilibre\Http\Controllers;

use Illuminate\Http\Request;
use equilibre\Http\Requests;
use equilibre\Ventas;
use Illuminate\Support\Facades\Redirect;
use equilibre\Http\Requests\ventasFormRequest;
use DB;
use equilibre\detalle_venta;

class ventasController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
   
    public function index(Request $request)
    {
        $query=trim($request->get('searchText'));
        $Ventas=DB::table('venta as v')
        ->join('persona as p','v.Persona_rut','=','p.rut')
        ->select('v.idventa','v.total_venta','v.fecha','p.rut as Persona')
        ->where ('estado','=','1')
        ->where('p.rut','LIKE','%'.$query.'%')
        ->where('p.rut','LIKE','%'.$query.'%')
        ->orderBy('v.idventa')
        ->paginate(10);
        return view('almacen.ventas.index',["venta"=>$Ventas,"searchText"=>$query]);
    }
    public function create()
    {
        return view("almacen.proveedor.create");
    }
    public function store (proveedorFormRequest $request)
    {
        $Provedor=new Provedor;
        $Provedor->idProveedor=$request->get('idProveedor');
        $Provedor->razonsocial=$request->get('razonsocial');
        $Provedor->direccion=$request->get('direccion');
        $Provedor->ciudad= $request->get('ciudad');
        $Provedor->pais=$request->get('pais');
        $Provedor->telefono=$request->get('telefono');
        $Provedor->correo= $request->get('correo');
        $Provedor->descripcion=$request->get('descripcion');
        $Provedor->Estado='1';
        $Provedor->save();
        return Redirect::to('almacen/proveedor');

    }
    public function show($id)
    {
        return view("almacen.proveedor.show",["proveedor"=>Provedor::findOrFail($id)]);
    }
    public function edit($id)
    {
        $detalle=DB::table('detalle_venta as d')
        ->join('venta as v','d.idventa','=','v.idventa')
        ->join('persona as p','d.Persona_rut','=','p.rut')
        ->join('producto as x','d.idproducto','=','x.idproducto') 
        ->select('d.idventa','d.Persona_rut','p.nombre as nombre','d.idproducto','x.nombre as producto','d.cantidad','d.precio_unitario','d.precio_total')
        ->where('d.idventa','LIKE','%'.$id.'%')
        ->orderBy('d.idventa')
        ->paginate(10);
        return view("almacen.ventas.edit",["detalle"=>$detalle]);
    }
    public function update(proveedorFormRequest $request,$id)
    {
        $Provedor=Provedor::findOrFail($id);
        $Provedor->idProveedor=$request->get('idProveedor');
        $Provedor->razonsocial=$request->get('razonsocial');
        $Provedor->direccion=$request->get('direccion');
        $Provedor->ciudad= $request->get('ciudad');
        $Provedor->pais=$request->get('pais');
        $Provedor->telefono=$request->get('telefono');
        $Provedor->correo= $request->get('correo');
        $Provedor->descripcion=$request->get('descripcion');
        $Provedor->update();
        return Redirect::to('almacen/proveedor');
    }
    public function destroy($id)
    {
        $ventas=ventas::findOrFail($id);
        $ventas->Estado='0';
        $ventas->update();
        return Redirect::to('almacen/ventas');
    }
}
