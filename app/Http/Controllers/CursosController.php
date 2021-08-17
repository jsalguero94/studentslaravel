<?php

namespace App\Http\Controllers;

use App\Cursos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CursosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //->where('Active',1)
        $cursos = DB::table('cursos')->get();
      // $cursos = Cursos::all();

        return $cursos;
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
            if((Cursos::find($request->Nombre))!=null)
            {return "Id ya existe";}
            else{
                $store = new Cursos;
        $store -> Nombre = $request->Nombre;
        $store -> Active = $request->Active;
        return $store->save();
            }

        }
        catch(\Exception $e){
            return $e;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Cursos  $cursos
     * @return \Illuminate\Http\Response
     */
    public function show(Cursos $cursos)
    {
        //TODO
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Cursos  $cursos
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cursos $cursos)
    {
        $update = $cursos::where('Nombre',$request->Nombre)->first();

        $update->Active = $request->Active;
        $update->save();

        return $update;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Cursos  $cursos
     * @return \Illuminate\Http\Response
     */
    public function destroy($nombre, Cursos $cursos)
    {
        // curso
       $delete = $cursos::find($nombre);

       return $delete->delete() ;
    }
}
