<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;


class AdvertConfiguration extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    /**
     * Dados para inserção em massa
     */
    protected $fillable = [
        'title', //título do anuncio
        'type', //tipo do anuncio //1 - slide com logo //2 - nuvem de logo //3 - Banners full por categoria //4 - Banner a direita
        'position', //1 - top //2 - left //3 - right //4 - bottom
        'amount', //quantidade disponível para venda
        'value', //valor mensal
        'width', //largura
        'height', //altura
        'status',
        'plan_id',
        'file_id' //arquivo do select
    ];


    /**
     * Dados que serão auditados/log
     */
    protected $auditInclude = [
        'title', //título do anuncio
        'type', //tipo do anuncio //1 - slide com logo //2 - nuvem de logo //3 - Banners full por categoria //4 - Banner a direita
        'type',
        'position', //1 - top //2 - left //3 - right //4 - bottom
        'position',
        'amount', //quantidade disponível para venda
        // 'value', //valor mensal
        'width', //largura
        'height', //altura
        'status',
        'plane_id',
        // 'file_id' //arquivo do select


    ];


    public function plane()
    {
        return $this->belongsTo(Plane::class);
    }

    // public function file()
    // {
    //     return $this->belongsTo(File::class, 'file_id', 'id');
    // }
}
