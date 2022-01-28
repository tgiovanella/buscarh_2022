<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class QuoteCandidateNotification extends Model
{

    protected $fillable = ['company_id', 'quote_id', 'is_view'];

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(function (Builder $builder) {

            //  $builder->where('is_view', 0);
        });
    }

    public function company()
    {
        return $this->hasMany(Company::class, 'id', 'company_id');
    }

    public function quote()
    {
        return $this->hasOne(Quote::class, 'id', 'quote_id');
    }

    public function isView()
    {
        return $this->is_view === 1;
    }
}
