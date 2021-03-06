<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Builders\SearchBuilder;

class Recordatorioproceso extends Model
{
    protected $table = 'recordatorio';
    public $timestamps = false;

    protected $fillable = ['observacion','fecha', 'proceso_id',
    'users_id', 'created_at'];

    public function newEloquentBuilder($builder) 
    { 
      return new SearchBuilder($builder); 
    }

}
