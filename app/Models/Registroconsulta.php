<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Builders\SearchBuilder;

class Registroconsulta extends Model
{
    protected $table = 'registroconsulta';
    public $timestamps = false;

    protected $fillable = ['personanatural_id','proceso_id', 
    'created_at'];

    public function newEloquentBuilder($builder) 
    { 
      return new SearchBuilder($builder); 
    }

}
