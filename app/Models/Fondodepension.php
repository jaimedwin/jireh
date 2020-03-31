<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Builders\SearchBuilder;

class Fondodepension extends Model
{
    protected $table = 'fondodepension';

    protected $fillable = ['abreviatura','descripcion', 'users_id', 
    'created_at', 'updated_at']; 

    public function newEloquentBuilder($builder) 
    { 
      return new SearchBuilder($builder); 
    }

}
