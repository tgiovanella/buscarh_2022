<?php

namespace App;

use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\Model;

class Report extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    const TAG_FALSE_DATA = 1; //DADOS FALSOS
    const TAG_COMPANY_NOT_EXIST = 2; //EMPRESA NÃO EXISTE
    const TAG_DATA_FROM_ANOTHER_PERSON = 3; //USO DE DADOS DE PROPRIEDADES DE OUTRAS PESSOAS
    const TAG_MISLEADING_CONTENT = 4; //CONTEÚDO ENGANOSO
    const TAG_INAPPROPRIATE_CONTENT = 5; //CONTEÚDO INAPROPRIADO
    const TAG_OTHERS = 99; //OUTROS

    const STATUS_PENDING = 1; //PENDENTE
    const STATUS_CONFIRMED = 2; //CONFIRMADO
    const STATUS_CANCELED = 3; //CANCELADO

    protected $fillable = [
        'tag', //1 - Dados Falsos; 2 - Empresa não existe; 3 - uso de dados de propriedades de outras pessoas; 4 - conteúdo enganoso; 5 - conteúdo impróprio; 99 - outros
        'observation', //conteúdo de texto livre para inserir observação
        'name', //nome do usuário denunciante
        'cpf_cnpj', //cpf/cnpj de quem fez a denuncia
        'email', //email do denunciante
        'token', //token para validação por email
        'is_valid', //se foi validado por email
        'company_id', //identificação da empresa denunciada
        'advert_id', //identificação do anúncio denunciado
        'status' //1 - Pendente; 2 - Confirmado; 3 - Cancelado/Não Procede; (status para desativar ou não o anúncio)
    ];


    /**
     * Dados que serão auditados/log
     */
    protected $auditInclude = [
        'tag',
        'observation',
        'name',
        'cpf_cnpj',
        'email',
        'token',
        'is_valid',
        'company_id',
        'advert_id',
        'status'
    ];


    public function company()
    {
        return $this->belongsTo('App\Company');
    }
}
