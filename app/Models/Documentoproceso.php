<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Builders\SearchBuilder;

class Documentoproceso extends Model
{
    protected $table = 'documentoproceso';

    protected $fillable = ['nombrearchivo',
    'tipodocumento_id', 'proceso_id', 
    'users_id', 'created_at', 'updated_at'];

    public function newEloquentBuilder($builder) 
    { 
      return new SearchBuilder($builder); 
    }
}
