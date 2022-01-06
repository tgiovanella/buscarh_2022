<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Plane extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    public const MONTHLY = 'MONTHLY';
    public const WEEKLY = 'WEEKLY';
    public const BIMONTHLY = 'BIMONTHLY';
    public const TRIMONTHLY = 'TRIMONTHLY';
    public const SEMIANNUALLY = 'SEMIANNUALLY';
    public const YEARLY = 'YEARLY';



    public const PLANES = ['WEEKLY', 'MONTHLY', 'BIMONTHLY', 'TRIMONTHLY', 'SEMIANNUALLY', 'YEARLY'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'reference', 'code', 'charge', 'period', 'amount_per_payment', 'membership_free', 'trial_period_duration', 'details'];

    protected $auditInclude = ['name', 'reference', 'code', 'charge', 'period', 'amount_per_payment', 'membership_free', 'trial_period_duration', 'details'];
}
