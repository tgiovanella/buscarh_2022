<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Quotation extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    const STATUS_OPEN = 1;
    const STATUS_CLOSE = 0;

    public function subcategories()
    {
        return $this->belongsToMany(Subcategory::class, 'quotation_subcategories');
    }

    public function ufs()
    {
        return $this->belongsToMany(State::class, 'quotation_operation_states');
    }

    public function cities()
    {
        return $this->belongsToMany(City::class, 'quotation_operation_cities');
    }
}
