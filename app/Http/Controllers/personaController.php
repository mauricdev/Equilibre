<?php

namespace equilibre\Http\Controllers;


use Illuminate\Http\Request;
use equilibre\Http\Requests;
use equilibre\Persona;
use Illuminate\Support\Facades\Redirect;
use equilibre\Http\Requests\personaFormRequest;
use DB;
use Response;


class personaController extends Controller
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
            $Persona=DB::table('persona')->where('nombre','LIKE','%'.$query.'%')
            ->orwhere ('rut','LIKE','%'.$query.'%')
            ->orderBy('rut')
            ->paginate(7);
            return view('almacen.persona.index',["personas"=>$Persona,"searchText"=>$query]);
        }
    }
    public function create()
    {
        return view("almacen.persona.create");
    }
    public function store (personaFormRequest $request)
    {
        $Persona=new Persona;
        $Persona->rut=$request->get('rut');
        $Persona->nombre=$request->get('nombre');
        $Persona->apellidos=$request->get('apellidos');
        $Persona->correo=$request->get('correo');  
        $Persona->direccion=$request->get('direccion');
        $Persona->ciudad=$request->get('ciudad');  
        $Persona->telefono=$request->get('telefono');
        $Persona->save();
        return Redirect::to('almacen/persona');

    }
    public function show($id)
    {
        return view("almacen.persona.show",["Personas"=>Persona::findOrFail($id)]);
    }
    public function edit($id)
    {
        
        return view("almacen.persona.edit",["Personas"=>Persona::findOrFail($id)])->with('id',$id);
    }
    public function update(personaFormRequest $request,$id)
    {
        $Persona=Persona::findOrFail($id);
        $Persona->nombre=$request->get('nombre');
        $Persona->apellidos=$request->get('apellidos');
        $Persona->correo=$request->get('correo');  
        $Persona->direccion=$request->get('direccion');
        $Persona->ciudad=$request->get('ciudad');  
        $Persona->telefono=$request->get('telefono');
        $Persona->update();
        return Redirect::to('almacen/persona');
    }
    public function export()
    {
        $headers = [
            'Cache-Control'       => 'must-revalidate, post-check=0, pre-check=0'
        ,   'Content-type'        => 'text/csv'
        ,   'Content-Disposition' => 'attachment; filename=Persona.csv'
        ,   'Expires'             => '0'
        ,   'Pragma'              => 'public'
    ];

    $list = Persona::all()->toArray();

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
