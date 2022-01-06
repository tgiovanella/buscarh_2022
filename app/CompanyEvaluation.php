<?php

namespace App;

// use App\User;
// use App\Company;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\Model;

class CompanyEvaluation extends Model  implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected $fillable = [
        'user_id',
        'company_id',
        'note',
        'message'
    ];

    protected $auditInclude = [
        'user_id',
        'company_id',
        'note',
        'message'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
