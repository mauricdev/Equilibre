<?php

namespace equilibre\Http\Controllers;


use Illuminate\Http\Request;
use equilibre\Http\Requests;
use equilibre\Persona;
use Illuminate\Support\Facades\Redirect;
use equilibre\Http\Requests\personaFormRequest;
use DB;

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
            ->paginate(10);
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
        return view("almacen.persona.edit",["Personas"=>Persona::findOrFail($id)]);
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


}
