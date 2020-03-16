<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Estado extends Model
{
    protected $table = 'estado';

    protected $fillable = ['descripcion', 'users_id', 
    'created_at', 'updated_at']; 
}
