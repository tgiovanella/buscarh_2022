<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Quote extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    const STATUS_OPEN = 'OPEN';
    const STATUS_CLOSE = 'CLOSE';

    protected $table = 'quotes';

    public function subcategories()
    {
        return $this->belongsToMany(Subcategory::class, 'quotes_subcategories');
    }

    public function cities()
    {
        return $this->belongsToMany(City::class, 'quotes_operation_cities');
    }

    public function candidates()
    {
        return $this->hasMany(QuoteCandidate::class, 'quote_id', 'id');
    }
}
