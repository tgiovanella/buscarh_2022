<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CompanyClick extends Model
{
    protected $fillable = ['letter_state', 'iso_state', 'city_name', 'company_name', 'company_id'];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
