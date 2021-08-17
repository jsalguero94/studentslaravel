<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Asignacion extends Model
{
    //

    protected $fillable = ['Estudiantes_Id','Careras_Id','Cursos','Jornada','created_at','updated_at','Active'];
    protected $table = 'Asignacion';
}
