<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Builders\SearchBuilder;

class Correo extends Model
{
    protected $table = 'correo';

    protected $fillable = ['electronico','principal', 'personanatural_id',
    'users_id', 'created_at', 'updated_at'];

    public function newEloquentBuilder($builder) 
    { 
      return new SearchBuilder($builder); 
    }
}
