<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Configuration extends Model
{


    // $table->string('name');
    //         $table->string('value');
    //         $table->char('type')->default('S'); /

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name','value','descriptions','type'];
}
