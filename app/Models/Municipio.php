<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Builders\SearchBuilder;

class Municipio extends Model
{
    protected $table = 'municipio';

    protected $fillable = ['nombre', 'departamento_id', 'users_id', 
    'created_at', 'updated_at'];

    public function newEloquentBuilder($builder) 
    { 
      return new SearchBuilder($builder); 
    }

}
