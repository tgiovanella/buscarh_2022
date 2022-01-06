<?php

namespace App;

use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\Model;

class PageBlock extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;



    /**
     * Dados para inserção em massa
     */
    protected $fillable = ['name', 'slug', 'status'];

    /**
     * Dados que serão auditados/log
     */
    protected $auditInclude = ['name', 'slug', 'status'];
}
