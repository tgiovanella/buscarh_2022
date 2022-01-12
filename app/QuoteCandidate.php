<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuoteCandidate extends Model
{
    protected $table = 'candidate_quotes';

    public function company()
    {
        return $this->hasOne(Company::class, 'company_id', 'id');
    }
}
