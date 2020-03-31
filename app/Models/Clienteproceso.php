<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Builders\SearchBuilder;

class Clienteproceso extends Model
{
    protected $table = 'clienteproceso';

    protected $fillable = ['personanatural_id','proceso_id', 'tipodemanda_id',
    'users_id', 'created_at', 'updated_at'];

    public function newEloquentBuilder($builder) 
    { 
      return new SearchBuilder($builder); 
    }
}
