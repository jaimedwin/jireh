<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ponente extends Model
{
    protected $table = 'ponente';

    protected $fillable = ['nombrecompleto', 'users_id', 
    'created_at', 'updated_at'];
}
