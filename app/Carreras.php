<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Carreras extends Model
{
    //
    protected $table = "carreras";
    protected $fillable = ['Nombre','Facultad','Active'];
}
