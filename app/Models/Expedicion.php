<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Builders\SearchBuilder;

class Expedicion extends Model
{
    protected $table = 'expedicion';

    protected $fillable = ['lugar', 'users_id', 
    'created_at', 'updated_at'];

    public function newEloquentBuilder($builder) 
    { 
      return new SearchBuilder($builder); 
    }

}
