<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Modulos;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\ItemCreateRequest;
use App\Http\Requests\ItemUpdateRequest;
use Illuminate\Support\Facades\Validator;
use DB;
use Input;
use Storage;

class ModulosController extends Controller
{
    public function index()
    {
     $postres = Modulos::all();
        return view('modulos.index', compact('moduloNuevo')); 
    }

    public function create()
    {
        $modulos = Modulos::all();
        return view('modulos.create', compact('moduloNuevo'));
    }

    public function store($request)
    {
        $modulos = new Modulos();
 
        $modulos->Nombre = $request->Nombre;
        $modulos->Duracion = $request->Precio;
        $modulos->Descripcion = $request->Descripcion;
 
        $modulos->save();;
 
        return redirect('modulos')->with('message','Guardado Satisfactoriamente !');
    }

    public function edit($id)
    {
        $postres = Modulos::find($id);
        return view('modulos.edit',['modulos'=>$modulos]);
    }

    public function update(ItemUpdateRequest $request, $id)
    {        
        $modulos = Modulos::find($id);
        $modulos->Nombre = $request->Nombre;
        $modulos->Duracion = $request->Precio;
        $modulos->Descripcion = $request->Descripcion;
        $modulos->save();
 
        Session::flash('message', 'Editado Satisfactoriamente !');
        return Redirect::to('modulos');
    }

    public function destroy($id){
        Modulos::destroy($id);
        Session::flash('message', 'Eliminado Satisfactoriamente !');
        return Redirect::to('modulos');
    }



}
