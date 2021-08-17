<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    $user = Auth::user();
    if($user != null)
    {return view('home');}
    else{
        return view('welcome');
    }

})->name('/');

Auth::routes();
Route::get('/login',function () {
    return view('welcome');
})->name('login');
Route::get('/home', 'HomeController@index')->name('home');
//Route::get('test', 'AsignacionController@test')->middleware('auth');

//Route::get('cursos', 'CursosController@index');

Route::middleware(['auth'])->group(function () {
//rutas con auth
Route::get('cursosv',function() {return view('Cursos');})->name('cursosvista');
Route::get('asignacionesv',function() {return view('Asignaciones');})->name('asignacionesvista');
Route::get('carrerasv',function() {return view('Carreras');})->name('carrerasvista');
Route::get('estudiantesv',function() {return view('Estudiantes');})->name('estudiantesvista');

});
