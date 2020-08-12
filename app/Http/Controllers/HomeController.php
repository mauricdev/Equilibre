<?php

namespace equilibre\Http\Controllers;

use equilibre\Http\Requests;
use Illuminate\Http\Request;
use DB;
use equilibre\User;
use Response;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        setlocale(LC_TIME, 'es_ES');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $pastel = DB::select("SELECT count('rut') as total, ciudad as ubicacion
        FROM persona GROUP BY ubicacion");

        $pastel2 = DB::select("SELECT sum(d.cantidad) as total, p.nombre  as producto
        FROM detalle_venta d
        INNER JOIN producto p ON  d.producto_idproducto =p.idproducto
        GROUP BY p.idproducto ORDER BY p.idproducto DESC LIMIT 5");

        $lineal = DB::select(" SELECT fechaHora as fecha ,  sum(total_venta) as total
        FROM venta WHERE Estado = 1 GROUP BY DATE_FORMAT(fecha, '%m/%y')  order by fecha");

        $linea2 = DB::select(" SELECT fechaHora as fecha ,  sum(total_venta) as total
        FROM venta WHERE Estado = 0 GROUP BY DATE_FORMAT(fecha, '%m/%y')  order by fecha");

        return view('almacen/dashborad/index', ["pastel" => $pastel, "pastel2" => $pastel2, "linea" => $lineal , "linea2" => $linea2]);
    }
    public function export()
    {
        $headers = [
            'Cache-Control'       => 'must-revalidate, post-check=0, pre-check=0'
        ,   'Content-type'        => 'text/csv'
        ,   'Content-Disposition' => 'attachment; filename=galleries.csv'
        ,   'Expires'             => '0'
        ,   'Pragma'              => 'public'
    ];

    $list = User::all()->toArray();

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
