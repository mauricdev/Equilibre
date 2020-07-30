<?php

namespace equilibre\Http\Controllers;

use Illuminate\Http\Request;
use equilibre\Http\Requests;
use equilibre\Provedor;
use Illuminate\Support\Facades\Redirect;
use equilibre\Http\Requests\proveedorFormRequest;
use DB;
use equilibre\User;

class proveedorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        

        if ($request)
        {
            $query=trim($request->get('searchText'));
            $proveedor=DB::table('proveedor')->where('idproveedor','LIKE','%'.$query.'%')
            ->where ('Estado','=','1')
            ->orderBy('idproveedor')
            ->paginate(7);
            return view('almacen.proveedor.index',["proveedor"=>$proveedor,"searchText"=>$query]);
        }
    }
    public function create()
    {
        return view("almacen.proveedor.create");
    }
    public function store (proveedorFormRequest $request)
    {
        $Provedor=new Provedor;
        $Provedor->idProveedor=$request->get('idproveedor');
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
        return view("almacen.proveedor.edit",["proveedor"=>Provedor::findOrFail($id)]);
    }
    public function update(proveedorFormRequest $request,$id)
    {
        $Provedor=Provedor::findOrFail($id);
        $Provedor->idProveedor=$request->get('idproveedor');
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
        $proveedor=Provedor::findOrFail($id);
        $proveedor->estado='0';
        $proveedor->update();
        return Redirect::to('almacen/proveedor');
    }
}
