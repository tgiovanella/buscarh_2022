<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SearchAnalytic extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'term',
        'languages',
        'device',
        'platform',
        'browser',
        'version_browser',
        'is_desktop',
        'user_id',
        'remote_addr',
        'url',
        'token'
    ];
}
