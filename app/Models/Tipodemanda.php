<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Builders\SearchBuilder;

class Tipodemanda extends Model
{
    protected $table = 'tipodemanda';

    protected $fillable = ['abreviatura','descripcion','comentario', 'users_id', 
    'created_at', 'updated_at'];

    public function newEloquentBuilder($builder) 
    { 
      return new SearchBuilder($builder); 
    }

}
