<?php

namespace equilibre\Http\Controllers;

use Illuminate\Http\Request;
use equilibre\Http\Requests;

use equilibre\User;
use Illuminate\Support\Facades\Redirect;
use equilibre\Http\Requests\UsuarioFormRequest;
use DB;
class UsuarioController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        if ($request)
        {
             //$user=auth()->user()->email;
            $query=trim($request->get('searchText'));
            $usuarios=DB::table('Users')->where('name','LIKE','%'.$query.'%')
            //->where('email','!=',$user)
            ->orderBy('id','desc')
            ->paginate(7);
            return view('almacen.usuario.index',["usuarios"=>$usuarios,"searchText"=>$query]);
        }
    }
    public function create()
    {
        return view("almacen.usuario.create");
    }
    public function store (UsuarioFormRequest $request)
    {
        $usuario=new User();
        $usuario->name =$request->get('name');
        $usuario->email =$request->get('email');
        $usuario->password =bcrypt($request->get('password'));
        $usuario->save();
        return Redirect::to('almacen/usuario');
    }
    public function edit($id)
    {
        return view("almacen.usuario.edit",["usuario"=>User::findOrFail($id)]);
    }

    public function update(UsuarioFormRequest $request,$id)
    {
        $usuario=User::findOrFail($id);
        $usuario->name =$request->get('name');
        $usuario->email =$request->get('email');
        $usuario->password =bcrypt($request->get('password'));
        $usuario->update();
        return Redirect::to('almacen/usuario');
    }

    public function destroy($id)
    {
        $usuario = DB::table('users')
        ->where('id','=', $id)->delete();
        return Redirect::to('almacen/usuario');
    }
}
