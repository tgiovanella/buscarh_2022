<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuoteComment extends Model
{
    protected $table = 'quote_comments';

    protected $fillable = [
        'candidate_id', 'quote_id', 'created_at', 'updated_at', 'finish_quote', 'user_id'
    ];
}
