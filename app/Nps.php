<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Nps extends Model
{
    protected $table = 'quotes_nps';

    protected $fillable = [
        'company_id', 'quote_id', 'created_at', 'updated_at', 'answer', 'user_id', 'comment'
    ];

    public function company()
    {
        return $this->hasOne(Company::class, 'id', 'company_id');
    }

    public function quote()
    {
        return $this->hasOne(Quote::class, 'id', 'quote_id');
    }
}
