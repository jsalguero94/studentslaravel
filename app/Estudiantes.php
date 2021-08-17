<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Estudiantes extends Model
{
    //
    protected $table = "estudiantes";
    protected $fillable = ['Nombres', 'description','Apellidos','Tipo_Identificacion','No_Identificacion','Sexo','Fecha_Nacimiento','Active'];
}
