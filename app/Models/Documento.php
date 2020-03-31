<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Builders\SearchBuilder;

class Documento extends Model
{
    protected $table = 'documento';

    protected $fillable = ['nombrearchivo',
    'tipodocumento_id', 'personanatural_id', 
    'users_id', 'created_at', 'updated_at'];

    public function newEloquentBuilder($builder) 
    { 
      return new SearchBuilder($builder); 
    }
}
