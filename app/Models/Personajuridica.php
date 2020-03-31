<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Builders\SearchBuilder;

class Personajuridica extends Model
{
    protected $table = 'personajuridica';

    protected $fillable = ['nit', 'razonsocial', 
    'direccion', 'personanatural_id',
    'users_id', 'created_at', 'updated_at'];

    public function personasnaturales()
    {
        $this->belongsTo('App\personajuridica');
    }

    public function newEloquentBuilder($builder) 
    { 
      return new SearchBuilder($builder); 
    }

}
