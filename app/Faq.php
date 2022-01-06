<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;


class Faq extends Model
implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    //
    protected $fillable = ['question', 'answer', 'order', 'slug', 'status'];
    protected $auditInclude = ['question', 'answer', 'order', 'slug', 'status'];
}
