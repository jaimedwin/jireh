<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Builders\SearchBuilder;

class Box extends Model
{
    protected $table = 'box';

    protected $fillable = ['abreviatura','descripcion', 
    'users_id', 'created_at', 'updated_at'];

    public function newEloquentBuilder($builder) 
    { 
      return new SearchBuilder($builder); 
    }
}
