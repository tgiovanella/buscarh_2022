<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CandidateBuyCoins extends Model
{
    protected $table = 'candidate_buy_coins';
    public $timestamps = false;

    public function company()
    {
        return $this->hasOne(Company::class, 'id', 'company_id');
    }
}
