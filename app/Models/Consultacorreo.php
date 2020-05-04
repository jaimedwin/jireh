<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Builders\SearchBuilder;

class Consultacorreo extends Model
{
    protected $table = 'consultacorreo';
    public $timestamps = false;

    protected $fillable = ['a','mensaje', 
    'consultacorreotipo_id', 'created_at'];

    public function newEloquentBuilder($builder) 
    { 
      return new SearchBuilder($builder); 
    }
}
