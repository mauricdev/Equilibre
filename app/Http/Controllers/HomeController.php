<?php

namespace equilibre\Http\Controllers;

use equilibre\Http\Requests;
use Illuminate\Http\Request;
use DB;
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
        return view('almacen/dashborad/index', ["pastel" => $pastel]);
    }
}
