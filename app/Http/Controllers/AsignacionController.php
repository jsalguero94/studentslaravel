<?php

namespace App\Http\Controllers;

use App\Asignacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class AsignacionController extends Controller
{
    public function test(){
        $crud = new Asignacion();
        $crud->save();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

         //->where('Active',1)
        // $asignaciones = DB::table('asignacion')->get();
        $asignaciones = DB::select('SELECT a.* FROM asignacion a
        INNER JOIN carreras c ON a.Carreras_Id = c.id
        INNER JOIN estudiantes e ON a.Estudiantes_Id = e.id
        INNER JOIN cursos cs ON a.Cursos = cs.Nombre
        WHERE c.Active = ? AND e.Active = ? AND cs.Active =?', [1,1,1]);

           return $asignaciones;
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $store = new Asignacion();
        $store -> Estudiantes_Id= $request->Estudiantes_Id;
        $store -> Carreras_Id = $request->Carreras_Id;
        $store -> Cursos = $request->Cursos;
        $store -> Jornada = $request->Jornada;
        $store -> Active = $request->Active;
        return $store->save();

    }





    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Asignacion  $asignacion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $idEstudiante=$request->Estudiantes_id;
        $idCarrera=$request->Carreras_id;
         $idCurso=$request->Cursos;
         $idEstudianteor=$request->Estudiantes_idor;
        $idCarreraor=$request->Carreras_idor;
         $idCursoor=$request->Cursosor;

         $Active=$request->Active;
         $Jornada=$request->Jornada;

              $update = DB::select(' UPDATE asignacion SET Estudiantes_Id = ?, Carreras_Id=?, Cursos=?, Jornada=?, Active=? WHERE Estudiantes_Id=? AND Carreras_Id=? AND Cursos=?
      ', [$idEstudiante ,$idCarrera,$idCurso,$Jornada,$Active,$idEstudianteor ,$idCarreraor,$idCursoor]);



    return $update;



    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Asignacion  $asignacion
     * @return \Illuminate\Http\Response
     */
    public function destroy($id,Asignacion $asignacion)
    {
        $delete = $asignacion::where('Estudiantes_Id', $id)->delete();
        //Borra por ID estudiante


        return $delete ;
    }
}
