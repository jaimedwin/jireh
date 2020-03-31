<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Builders\SearchBuilder;

class Estado extends Model
{
    protected $table = 'estado';

    protected $fillable = ['descripcion', 'users_id', 
    'created_at', 'updated_at']; 
    
    public function newEloquentBuilder($builder) 
    { 
      return new SearchBuilder($builder); 
    }

}
