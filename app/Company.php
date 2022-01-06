<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Foundation\Auth\User;

/**
 * Dados da compania/empresa no qual será anunciada
 */
class Company extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    /**
     * Dados para inserção em massa
     */
    protected $fillable = [
        'name', #nome
        'fantasy', #nome fantasia
        'cpf_cnpj', #c
        'site', #url do site
        'phone', #telefone
        'cep', #cep
        'uf', #uf
        'address', #endereço - logradouro
        'number', #numero (inteiro) - se for S/N então é ZERO (0)
        'district', #bairro
        'city_id', #cidade
        'complement', #complemento
        'responsible', #nome do responsável
        'email', #email
        'owner_id', #usuário dono da empresa (para administrar)
        'status', //ativo e inativo (boolean)
        'highlighted',
        'slug'
    ];

    /**
     * Dados que serão auditados/log
     */
    protected $auditInclude = [
        'name', #nome
        'fantasy', #nome fantasia
        'cpf_cnpj', #c
        'site', #url do site
        'phone', #telefone
        'cep', #cep
        'uf', #uf
        'address', #endereço - logradouro
        'city_id',
        'number', #numero (inteiro) - se for S/N então é ZERO (0)
        'district', #bairro
        'complement', #complemento
        'responsible', #nome do responsável
        'email', #email
        'owner_id',
        'status', //ativo e inativo (boolean)
        'highlighted',
        'slug'
    ];

    /**
     * Retorna os dados da cidade vinculado a empresa
     *
     * @return void
     */
    public function city()
    {
        return $this->belongsTo(City::class);
    }

    /**
     * Usuário dono da empresa, no caso se um usuário cadastra a empresa/anunciante
     *
     * @return void
     */
    public function owner()
    {
        return $this->belongsTo(User::class);
    }

    //muitos para muitos
    public function subcategories()
    {
        return $this->belongsToMany(Subcategory::class, 'company_subcategories');
    }

    public function operation_ufs()
    {
        return $this->belongsToMany(State::class, 'company_operation_states');
    }

    public function operation_cities()
    {
        return $this->belongsToMany(City::class, 'company_operation_cities');
    }

    public function reports()
    {
        return $this->hasMany('App\Report');
    }
}
