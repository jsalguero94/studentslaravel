<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cursos extends Model
{   /**
    * The model's default values for attributes.
    *
    * @var array
    * protected $attributes = [
    *   'delayed' => false,
    *];
    */
    protected $table = 'cursos';
    protected  $primaryKey = 'Nombre';
    protected $fillable = ['Nombre','Active'];
    public $incrementing = false;
    protected $keyType = 'string';
}
