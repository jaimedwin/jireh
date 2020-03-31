<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Builders\SearchBuilder;

class Corporacion extends Model
{
    protected $table = 'corporacion';

    protected $fillable = ['nombre','correonotificacion', 'users_id', 
    'created_at', 'updated_at'];
    
    public function newEloquentBuilder($builder) 
    { 
      return new SearchBuilder($builder); 
    }
}
