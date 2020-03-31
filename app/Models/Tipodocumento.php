<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Builders\SearchBuilder;

class Tipodocumento extends Model
{
    protected $table = 'tipodocumento';

    protected $fillable = ['abreviatura','descripcion','comentario', 'users_id', 
    'created_at', 'updated_at']; 
    
    public function newEloquentBuilder($builder) 
    { 
      return new SearchBuilder($builder); 
    }

}
