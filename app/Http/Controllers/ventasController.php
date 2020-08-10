<?php

namespace equilibre\Http\Controllers;

use Illuminate\Http\Request;
use equilibre\Http\Requests;
use equilibre\Ventas;
use Illuminate\Support\Facades\Redirect;
use equilibre\Http\Requests\ventasFormRequest;
use DB;
use equilibre\detalle_venta;
use Response;

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
        ->join('persona as p','v.persona_rut1','=','p.rut')
        ->select('v.idventa','v.total_venta','v.fechaHora','p.rut as Persona')
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


    }
    public function show($id)
    {
        return view("almacen.proveedor.show",["proveedor"=>Provedor::findOrFail($id)]);
    }
    public function edit($id)
    {
        $detalle=DB::table('detalle_venta as d')
        ->join('venta as v','d.venta_idventa','=','v.idventa')
        ->join('persona as p','d.venta_persona_rut','=','p.rut')
        ->join('producto as x','d.producto_idproducto','=','x.idproducto') 
        ->select('d.venta_idventa','d.venta_persona_rut as persona','p.nombre as nombre','p.apellidos as apellidos','d.producto_idproducto','x.nombre as producto','d.cantidad','d.precio_unitario','d.precio_total','v.total_venta as total')
        ->where('d.venta_idventa','LIKE','%'.$id.'%')
        ->orderBy('d.venta_idventa')
        ->paginate(7);


        return view("almacen.ventas.edit",["detalle"=>$detalle ,"venta"=>Ventas::findOrFail($id) ]);
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

    public function export()
    {
        $headers = [
            'Cache-Control'       => 'must-revalidate, post-check=0, pre-check=0'
        ,   'Content-type'        => 'text/csv'
        ,   'Content-Disposition' => 'attachment; filename=Ventas.csv'
        ,   'Expires'             => '0'
        ,   'Pragma'              => 'public'
    ];

    $list = Ventas::all()->toArray();

    # add headers for each column in the CSV download
    array_unshift($list, array_keys($list[0]));

   $callback = function() use ($list) 
    {
        $FH = fopen('php://output', 'w');
        foreach ($list as $row) { 
            fputcsv($FH, $row);
        }
        fclose($FH);
    };

    return Response::stream($callback, 200, $headers);
    }

}
