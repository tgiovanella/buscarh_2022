<?php

namespace App\Http\Controllers\Api;

use App\Company;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class CompanyController extends Controller
{
    public function companiesLike($term = null)
    {


        return Company::select('companies.id', DB::raw('CONCAT(companies.name," - CNPJ: ",CONCAT(companies.cpf_cnpj," - Cidade: ", CONCAT(cities.title,"/",companies.uf))) as text'))
            ->when(isset($term) && !empty($term), function ($q) use ($term) {
                return $q->where('companies.name', 'like', '%' . $term . '%');
            })
            ->where('companies.status', true)
            ->leftJoin('cities', 'cities.id', '=', 'companies.city_id')
            ->get();
    }


    public function company($id)
    {


        return Company::
            select(
                'companies.id',
                'companies.name',
                'companies.fantasy',
                'companies.cpf_cnpj',
                'companies.responsible',
                'companies.email',
                'cities.title',
                'companies.uf'
            )
            // ->when(isset($term) && !empty($term), function ($q) use ($term) {
            //         return $q->where('companies.name','like', '%'.$term.'%');
            // })
            ->where('companies.status', true)
            ->leftJoin('cities', 'cities.id', '=', 'companies.city_id')
            ->find($id);
    }
}
