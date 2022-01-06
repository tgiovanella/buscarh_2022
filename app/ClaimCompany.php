<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class ClaimCompany extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    protected $fillable = ['user_id', 'company','company_id', 'name', 'cpf', 'rg_cnh', 'cnpj', 'token', 'document_photo_file_id', 'cnh_rg_photo_file_id'];

    protected $auditInclude = ['user_id', 'company', 'company_id', 'name', 'cpf', 'rg_cnh', 'cnpj', 'token', 'document_photo_file_id', 'cnh_rg_photo_file_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
