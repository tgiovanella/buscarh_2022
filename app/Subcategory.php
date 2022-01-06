<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use App\Company;

class Subcategory extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    /**
     * Dados para inserção em massa
     */
    protected $fillable = [
        'name',
        'slug',
        'category_id',
    ];

    /**
     * Dados para auditoria
     */
    protected $auditInclude = [
        'name',
        'slug',
        'category_id',
    ];


    /**
     * A categoria que faz parte
     *
     * @return void
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }


    public function companies() {
        return $this->belongsToMany(Company::class, 'company_subcategories');
    }
}
