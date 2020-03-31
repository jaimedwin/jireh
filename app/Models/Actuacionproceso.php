<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Builders\SearchBuilder;

class Actuacionproceso extends Model
{
    protected $table = 'actuacionproceso';

    protected $fillable = ['fechaactuacion','actuacion', 'anotacion',
    'nombrearchivo', 'fechainiciatermino', 'fechafinalizatermino', 
    'fecharegistro', 'proceso_id', 
    'users_id', 'created_at', 'updated_at'];

    public function newEloquentBuilder($builder) 
    { 
      return new SearchBuilder($builder); 
    }

}
