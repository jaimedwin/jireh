<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Builders\SearchBuilder;

class Departamento extends Model
{
    protected $table = 'departamento';

    protected $fillable = ['nombre', 'users_id', 
    'created_at', 'updated_at'];

    public function newEloquentBuilder($builder) 
    { 
      return new SearchBuilder($builder); 
    }
}
