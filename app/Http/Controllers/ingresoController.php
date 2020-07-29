<?php

namespace equilibre\Http\Controllers;

use equilibre\Http\Requests;
use Illuminate\Http\Request;


use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use equilibre\Http\Requests\ingresoFormRequest;
use equilibre\ingreso;
use equilibre\detalle_ingeso;
use DB;

use Carbon\Carbon;
use Response;
use Illuminate\Support\Collection;

class ingresoController extends Controller
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
            $Ingresos=DB::table('ingreso as i')
            ->join('proveedor as p', 'i.proveedor_idproveedor','=','p.idproveedor ')
            ->join('detalle_ingreso as d', 'i.idingreso','=','d.ingreso_idingreso')
            ->select('i.idingreso','i.fechaHora','i.tipoComprobante','i.numeroComprobante','i.proveedor_idproveedor ','p.razonsocial',DB::raw('sum(d.cantidad*d.precio_compra) as total'))
            ->where('i.numeroComprobante','LIKE','%'.$query.'%')
            ->orderBy('i.idingreso','desc')
            ->groupBy('i.idingreso','i.fechaHora','i.tipoComprobante','i.numeroComprobante','i.proveedor_idproveedor')
            ->paginate(10);
            return view('almacen.ingreso.index',["ingreso"=>$Ingresos,"searchText"=>$query]);
        }
    }

    public function create()
    {
        $personas=DB::table('proveedor')->get();
        $articulos=DB::table('producto as p')
            ->select(DB::raw('CONCAT(p.idproducto," ",p.nombre)AS articulo'),'p.idproducto')
            ->where('p.Estado','=','1')
            ->get();
        return view("almacen.ingreso.index",["personas"=>$personas,"articulos"=>$articulos]);
    }

    public function store(ingresoFormRequest $request)
    {
        try{
            DB::beginTransaction();
                $ingreso = new ingreso;
                $ingreso->idingreso=$request->get('idingreso');
                $ingreso->proveedor_idproveedor=$request->get('proveedor_idproveedor');
                $ingreso->tipoComprobante=$request->get('tipoComprobante');
                $ingreso->numeroComprobante=$request->get('numeroComprobante');                
                $myTime = Carbon::now('America/Santiago');
                $ingreso->fechHora = $myTime->toDateTimeString();
                $ingreso->Estado = 1;                
                $ingreso->save();

                $idArticulo = $request->get('ingreso_idingreso');
                $cantidad   = $request->get('cantidad');
                $precio_compra= $request->get('precio_compra');

                $cont = 0;

                while($cont < count($idArticulo))
                {
                    $detalle = new detalle_ingeso();
                    $detalle->ingreso_idingreso= $ingreso->idingreso;
                    $detalle->producto_idproducto = $idArticulo[$cont];
                    $detalle->cantidad =  $cantidad[$cont]; 
                    $detalle->precio_compra = $precio_compra[$cont]; 
                    $detalle->save();
                    $cont = $cont + 1 ;
                }

            DB::commit();
        }catch(\Exception $e)
        {
            DB::rollback();
        }
        return redirect('almacen/ingreso');
    }

    public function show($id)
    {
            $Ingresos=DB::table('ingreso as i')
            ->join('proveedor as p', 'i.proveedor_idproveedor','=','p.idproveedor ')
            ->join('detalle_ingreso as d', 'i.idingreso','=','d.ingreso_idingreso')
            ->select('i.idingreso','i.fechaHora','i.tipoComprobante','i.numeroComprobante','i.proveedor_idproveedor ','p.razonsocial',DB::raw('sum(d.cantidad*d.precio_compra) as total'))
            ->where('i.idingreso','=',$id)
            ->first();    

            $detalle =DB::table('detalle_ingreso as d')   
            ->join('producto as p','d.producto_idproducto','=','p.idproducto')
            ->select('p.nombre as producto','d.cantidad','d.precio_compra')
            ->where('d.ingreso_idingreso','=',$id)
            ->get();
        return view("almacen.ingreso.show",["ingreso"=>$Ingresos,"detalle"=>$detalle]);
    }

    public function destroy($id)
    {
        $ingreso = ingreso::findOrFail($id);
        $ingreso->Estado='1';
        $ingreso->update();
        return redirect('almacen/ingreso');
    }
}
