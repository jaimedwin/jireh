<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Builders\SearchBuilder;

class Telefono extends Model
{
    protected $table = 'telefono';

    protected $fillable = ['prefijo', 'numero',
    'principal', 'personanatural_id',
    'users_id', 'created_at', 'updated_at'];

    public function newEloquentBuilder($builder) 
    { 
      return new SearchBuilder($builder); 
    }

}
