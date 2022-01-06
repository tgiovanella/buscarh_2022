<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    protected $fillable =['title', 'letter', 'iso', 'slug', 'population'];

}
