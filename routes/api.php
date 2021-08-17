<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


//Cursos
Route::get('cursos', 'CursosController@index');
Route::post('cursos', 'CursosController@store');
Route::put('cursos', 'CursosController@update');
Route::delete('cursos/{nombre}', 'CursosController@destroy');
//Carreras
Route::get('carreras', 'CarrerasController@index');
Route::post('carreras', 'CarrerasController@store');
Route::put('carreras', 'CarrerasController@update');
Route::delete('carreras/{id}', 'CarrerasController@destroy');
//Estudiantes
Route::get('estudiantesnombres', 'EstudiantesController@list');
Route::get('estudiantes', 'EstudiantesController@index');
Route::post('estudiantes', 'EstudiantesController@store');
Route::put('estudiantes', 'EstudiantesController@update');
Route::delete('estudiantes/{id}', 'EstudiantesController@destroy');
//Asignaciones
Route::get('asignaciones', 'AsignacionController@index');
Route::post('asignaciones', 'AsignacionController@store');
Route::post('asignacionesupd', 'AsignacionController@update');
Route::delete('asignaciones/{id}', 'AsignacionController@destroy');

//TODO
//GETLIST para cada tabla


