<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Builders\SearchBuilder;

class Contrato extends Model
{
    protected $table = 'contrato';

    protected $fillable = ['nombrearchivo','numero','valor', 
    'personanatural_id', 'proceso_id', 'tipocontrato_id',
    'users_id', 'created_at', 'updated_at'];

    public function newEloquentBuilder($builder) 
    {
      return new SearchBuilder($builder); 
    }
}
