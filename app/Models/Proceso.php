<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Builders\SearchBuilder;

class Proceso extends Model
{
    protected $table = 'proceso';

    protected $fillable = ['codigo','numero','ciudadproceso_id',
    'corporacion_id', 'ponente_id', 'estado_id',
    'users_id', 'created_at', 'updated_at'];

    public function newEloquentBuilder($builder) 
    { 
      return new SearchBuilder($builder); 
    }

}
