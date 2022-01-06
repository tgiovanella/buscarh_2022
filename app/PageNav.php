<?php

namespace App;


use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class PageNav extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    /**
     * Dados para inserção em massa
     */
    protected $fillable = ['name','slug','block','url','page_block_id','observation','status'];

    // ['title' => 'Teste','slug' => 'teste','body' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.']
    /**
     * Dados que serão auditados/log
     */
    protected $auditInclude = ['name','slug','url','page_block_id', 'order','observation','status'];

    public function block()
    {
        return $this->belongsTo(PageBlock::class,'page_block_id','id');
    }
}
