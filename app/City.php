<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class City extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;


    public $fillable = ['state_id', 'title', 'iso', 'iso_ddd', 'status', 'slug', 'population', 'lat', 'long', 'income_per_capita'];


    public function state()
    {
        return $this->belongsTo(State::class);
    }

}
