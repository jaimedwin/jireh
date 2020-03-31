<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Builders\SearchBuilder;

class Pago extends Model
{
    protected $table = 'pago';

    protected $fillable = ['fecha','abono', 
    'nrecibo', 'contrato_id',
    'users_id', 'created_at', 'updated_at'];

    public function newEloquentBuilder($builder) 
    { 
      return new SearchBuilder($builder); 
    }

}
