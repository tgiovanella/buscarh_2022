<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Company;
use App\City;
use Faker\Generator as Faker;



$factory->define(Company::class, function (Faker $faker) {

    $city =  City::inRandomOrder()
        ->first();
    return [
        'name' => $faker->company, #nome
        'fantasy' => $faker->company, #nome fantasia
        'cpf_cnpj' => $faker->boolean ? $faker->cpf : $faker->cnpj, #c
        'site' => $faker->url , #url do site
        'phone' =>  $faker->phone, #telefone
        'cep' => $faker->postcode, #cep
        // 'uf' => $faker->randomElement(['AC','AL','AP','AM','BA','CE','DF','ES','GO','MA','MT','MS','MG','PA','PB','PR','PE','PI','RJ','RN','RS','RO','RR','SC','SP','SE','TO']), #uf
        'uf' => $city->state->letter,
        'address' => $faker->streetName, #endereço - logradouro
        'number' => $faker->buildingNumber, #numero (inteiro) - se for S/N então é ZERO (0)
        'district' => $faker->city, #bairro
        'city_id' => $city->id, #cidade
        'complement' => $faker->country, #complemento
        'responsible' => $faker->name, #nome do responsável
        'email' => $faker->safeEmail, #email
        'owner_id' => rand(1,2), #usuário dono da empresa (para administrar)
    ];
});
