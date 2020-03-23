<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Actuacionproceso extends Model
{
    protected $table = 'actuacionproceso';

    protected $fillable = ['fechaactuacion','actuacion', 'anotacion',
    'nombrearchivo', 'fechainiciatermino', 'fechafinalizatermino', 
    'fecharegistro', 'proceso_id', 
    'users_id', 'created_at', 'updated_at'];
}
