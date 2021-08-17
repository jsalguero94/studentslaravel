<?php

namespace App\Http\Controllers;

use App\Carreras;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CarrerasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $carreras = DB::table('carreras')->get();

        echo $carreras;
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


                $store = new Carreras;
        $store -> Nombre = $request->Nombre;
        $store -> Facultad = $request->Facultad;
        $store -> Active = $request->Active;
        return $store->save();

        }

    /**
     * Display the specified resource.
     *
     * @param  \App\Carreras  $carreras
     * @return \Illuminate\Http\Response
     */
    public function show(Carreras $carreras)
    {
        //TODO
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Carreras  $carreras
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Carreras $carreras)
    {
        $update = $carreras::where('id',$request->id)->first();
        $update -> Nombre = $request->Nombre;
        $update -> Facultad = $request->Facultad;
        $update -> Active = $request->Active;
        $update->save();

        return $update;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Carreras  $carreras
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Carreras $carreras)
    {
        $delete = $carreras::find($id);

        return $delete->delete() ;
    }
}
