<?php

namespace equilibre\Http\Controllers;

use Illuminate\Http\Request;
use equilibre\Http\Requests;
use equilibre\Articulo;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use equilibre\Http\Requests\ArticuloFormRequest;
use DB;
use Response;

class ArticuloController extends Controller
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
            $Articulos=DB::table('producto as p')
            ->join('categoria as c','p.categoria_idcategoria','=','c.idcategoria')
            ->select('p.idproducto','p.nombre','c.nombre as categoria','p.unidad_medida','p.precio_compra','p.precio_venta','p.precio_descuento','p.descuento as descuento','p.stock','p.stock_critico','p.Estado','p.imagen')
            ->where('p.idproducto','LIKE','%'.$query.'%')
            ->orwhere('p.nombre','LIKE','%'.$query.'%')
            ->orderBy('p.idproducto')
            ->paginate(5);
            return view('almacen.articulo.index',["articulos"=>$Articulos,"searchText"=>$query]);
        }
    }

    public function create()
    {
        $categorias=DB::table('categoria')->where('estado','=','1')->get();
        return view("almacen.articulo.create",["categorias"=>$categorias]);
    }

    public function store (ArticuloFormRequest $request)
    {
        $Articulos=new Articulo();
        $Articulos->categoria_idcategoria =$request->get('categoria_idcategoria');
        $Articulos->idproducto =$request->get('idproducto');
        $Articulos->nombre=$request->get('nombre');
        $Articulos->unidad_medida=$request->get('unidad_medida');
        $Articulos->precio_compra=$request->get('precio_compra');
        $Articulos->precio_venta=$request->get('precio_venta');
        $Articulos->stock=$request->get('stock');
        $Articulos->stock_critico=$request->get('stock_critico');
        $Articulos->descuento = $request->get('descuento');
        $descuento = $request->get('descuento');
        $precio_venta = $request->get('precio_venta');
        $Articulos->precio_descuento= $precio_venta - ($descuento * $precio_venta /100);
        $Articulos->estado='1';        
        if(Input::hasFile('imagen')){
            $file=Input::file('imagen');
            $file->move(public_path().'/imagenes/articulos/',$file->getClientOriginalName());
            $Articulos->imagen=$file->getClientOriginalName();
        }
        $Articulos->save();
        return Redirect::to('almacen/articulo');
    }

    public function show($id)
    {
        return view("almacen.articulo.show",["articulo"=>Articulo::findOrFail($id)]);
    }

    public function edit($id)
    {
        $Articulos = Articulo::findOrFail($id);
        $categorias= DB::table('categoria')->where('estado','=','1')->get();
        return view("almacen.articulo.edit",["articulo"=>$Articulos,"categorias"=>$categorias]);
    }

    public function update(ArticuloFormRequest $request,$id)
    {
        $Articulos=Articulo::findOrFail($id);
        $Articulos->categoria_idcategoria =$request->get('categoria_idcategoria');
        $Articulos->idproducto =$request->get('idproducto');
        $Articulos->nombre=$request->get('nombre');
        $Articulos->unidad_medida=$request->get('unidad_medida');
        $Articulos->precio_compra=$request->get('precio_compra');
        $Articulos->precio_venta=$request->get('precio_venta');
        $Articulos->stock=$request->get('stock');
        $Articulos->stock_critico=$request->get('stock_critico');
        $Articulos->descuento = $request->get('descuento');
        $descuento = $request->get('descuento');
        $precio_venta = $request->get('precio_venta');
        $Articulos->precio_descuento= $precio_venta - ($descuento * $precio_venta /100);
        $Articulos->Estado=$request->get('Estado');     
        if(Input::hasFile('imagen')){
            $file=Input::file('imagen');
            $file->move(public_path().'/imagenes/articulos/',$file->getClientOriginalName());
            $Articulos->imagen=$file->getClientOriginalName();
        }
        $Articulos->update();
        return Redirect::to('almacen/articulo');
    }

    public function destroy($id)
    {
        $Articulos=Articulo::findOrFail($id);
        if($Articulos->Estado == 0){
            $Articulos->Estado='1';
        }else{
            $Articulos->Estado='0';
        }             
        $Articulos->update();
        return Redirect::to('almacen/articulo');
    }
    public function export()
    {
        $headers = [
            'Cache-Control'       => 'must-revalidate, post-check=0, pre-check=0'
        ,   'Content-type'        => 'text/csv'
        ,   'Content-Disposition' => 'attachment; filename=Productos.csv'
        ,   'Expires'             => '0'
        ,   'Pragma'              => 'public'
        ,   'Content-Transfer-Encoding' => 'UTF-8'
    ];

    $list = Articulo::all()->toArray();

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
