<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Category extends Model implements Auditable
{

    use \OwenIt\Auditing\Auditable;

    /**
     * Dados para inserção em massa
     */
    protected $fillable = [

        'name',
        'order',
        'slug'
    ];

    /**
     * Dados que serão auditados/log
     */
    protected $auditInclude = [

        'name',
        'order',
        'slug'
    ];



    /**
     * Todas as subcategorias vinculadas a categoria
     *
     * @return void
     */
    public function subcategories()
    {
        return $this->hasMany(Subcategory::class);
    }
}
