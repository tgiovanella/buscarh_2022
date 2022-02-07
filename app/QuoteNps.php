<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuoteNps extends Model
{
    protected $table = 'quotes_nps';

    protected $fillable = [
        'company_id', 'quote_id', 'created_at', 'updated_at', 'finish_quote', 'user_id', 'comment', 'answer'
    ];
}
