<?php

namespace App;

use App\Admin;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Contact extends Model
implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    public const STATUS_PENDING = 1;
    public const STATUS_READ = 2;

    protected $fillable = [
        'name',
        'subject',
        'email',
        'message'
    ];

    protected $auditInclude = [
        'name',
        'subject',
        'email',
        'message'
    ];

    public function admin() {
        return $this->belongsTo(Admin::class);
    }

}
