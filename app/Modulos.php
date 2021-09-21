<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Modulos extends Model
{
    protected $table = 'postres';
    protected $fillable = ['Nombre', 'Duracion','Descripcion'];
    

}
