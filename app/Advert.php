<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;


/**
 * Anuncios das empresas
 */
class Advert extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;


    //TIPO
    const TYPE_SLIDE = 1;
    const TYPE_CLOUD = 2;
    const TYPE_FULL = 3;
    const TYPE_SIDEBAR = 4;
    const TYPE_HIGHLIGHT = 5;

    //POSITION
    const POSITION_TOP = 1;
    const POSITION_LEFT = 2;
    const POSITION_RIGHT = 3;
    const POSITION_BOTTOM = 4;

    //STATUS
    const STATUS_PENDING = 1; //PENDENTE
    const STATUS_APPROVED = 2; //APROVADO PELA EQUIPE DO BUSCA WEB RH
    const STATUS_WAIT_PAYMENT = 3; //AGUARDANDO PAGAMENTO
    const STATUS_ANNOUNCED = 4; //ANUNCIADO //pAGAMENTO OK
    const STATUS_CANCELED = 5; //CANCELADO/RECUSADO PAGAMENTO
    const STATUS_LOSER = 6; //VENCIDO


    // const REALIZED = 1;
    // const PAYMENT = 2;
    // const APPROVED = 3;
    // const ANNOUNCED = 4;





    /**
     * Dados para inserção em massa
     */
    protected $fillable = [

        'title', //título do anuncio
        'description', //alguma descrição ou observação
        'type', //tipo do anuncio //1 - slide com logo //2 - nuvem de logo //3 - Banners full por categoria //4 - Banner a direita
        'position', //1 - top //2 - left //3 - right //4 - bottom
        'status', //1 - PENDENTE //2 - APROVADO //3 - CANCELADO //4 - VENCIDO
        'file_id', //'caminho do arquivo
        'advert_configuration_id', //configurações tamanho , valor, etc..
        'site',
        'subcategory_id',

        'has_company', //se tem ou não empresa vinculado
        'email_payment', //email para enviar o pagamento
        'responsible_payment', //responsável

        'order_payment_id',

        'token_id',
        'company_id',
        'user_id',

        'phone'

    ];


    /**
     * Dados que serão auditados/log
     */
    protected $auditInclude = [
        'title', //título do anuncio
        'description', //alguma descrição ou observação
        'type', //tipo do anuncio //1 - slide com logo //2 - nuvem de logo //3 - Banners full por categoria //4 - Banner a direita
        'position', //1 - top //2 - left //3 - right //4 - bottom
        'status', //1 - PENDENTE //2 - APROVADO //3 - CANCELADO //4 - VENCIDO
        'file_id', //'caminho do arquivo
        'advert_configuration_id', //configurações tamanho , valor, etc..
        'site',
        'subcategory_id',

        'user_id',
        'order_payment_id',

        'token_id',


        'has_company',
        'email_payment',
        'responsible_payment',
        'company_id', 'phone'


    ];

    public function subcategory()
    {
        return $this->belongsTo(Subcategory::class);
    }

    public function file()
    {
        return $this->belongsTo(File::class, 'file_id', 'id');
    }

    public function configuration()
    {
        return $this->belongsTo(AdvertConfiguration::class, 'advert_configuration_id', 'id');
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function reports()
    {
        return $this->hasMany(Report::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function order_payment()
    {
        return $this->belongsTo(OrderPayment::class);
    }
}
