<?php

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class UpdateSlugCompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $companies = App\Company::all();

        foreach($companies as $company)
        {
            $company->slug = create_slug_company($company->name,$company->cpf_cnpj, $company->id);
            $company->save();
        }
    }
}
