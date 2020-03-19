<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Expedicion extends Model
{
    protected $table = 'expedicion';

    protected $fillable = ['lugar', 'users_id', 
    'created_at', 'updated_at'];
}
