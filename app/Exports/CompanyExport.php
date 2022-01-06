<?php

namespace App\Exports;

use App\Company;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CompanyExport implements FromCollection, WithHeadings
{
    use Exportable;

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Company::select(
            'name',
            'fantasy',
            'cpf_cnpj',
            'site',
            'phone',
            'cep',
            'address',
            'district',
            'responsible',
            'email'
            )->get();
    }

    public function headings(): array
    {
        return [
         'Nome',
         'Fantasia',
         'Cpf/Cnpj',
         'Site',
         'Telefone',
         'CEP',
         'Endereço',
         'Bairro',
         'Responsável',
         'Email'
        ];
    }
}
