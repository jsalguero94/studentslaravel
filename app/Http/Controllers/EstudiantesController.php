<?php

namespace App\Http\Controllers;

use App\Estudiantes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class EstudiantesController extends Controller
{
    public function list()
    {
        $estudiantes = DB::table('estudiantes')->get(['id','Nombres','Apellidos']);
        // $estudiantes = Estudiantes::all();

          return $estudiantes;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         //->where('Active',1)
         $estudiantes = DB::table('estudiantes')->get();
         // $estudiantes = Estudiantes::all();

           return $estudiantes;
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $store = new Estudiantes;
        $store -> Nombres= $request->Nombres;
        $store -> Apellidos = $request->Apellidos;
        $store -> Tipo_Identificacion = $request->Tipo_Identificacion;
        $store -> No_Identificacion = $request->No_Identificacion;
        $store -> Sexo = $request->Sexo;
        $store -> Fecha_Nacimiento = $request->Fecha_Nacimiento;
        $store -> Active = $request->Active;
        return $store->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Estudiantes  $estudiantes
     * @return \Illuminate\Http\Response
     */
    public function show(Estudiantes $estudiantes)
    {
        //TODO
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Estudiantes  $estudiantes
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Estudiantes $estudiantes)
    {
        $update = $estudiantes::where('id',$request->id)->first();
        $update -> Nombres= $request->Nombres;
        $update -> Apellidos = $request->Apellidos;
        $update -> Tipo_Identificacion = $request->Tipo_Identificacion;
        $update -> No_Identificacion = $request->No_Identificacion;
        $update -> Sexo = $request->Sexo;
        $update -> Fecha_Nacimiento = $request->Fecha_Nacimiento;
        $update -> Active = $request->Active;
        $update->save();

        return $update;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Estudiantes  $estudiantes
     * @return \Illuminate\Http\Response
     */
    public function destroy($id,Estudiantes $estudiantes)
    {
        $delete = $estudiantes::find($id);

        return $delete->delete() ;
    }
}
