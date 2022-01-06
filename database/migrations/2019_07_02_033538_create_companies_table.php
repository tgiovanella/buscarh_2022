<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name'); //nome da empresa ou razão social
            $table->string('fantasy'); //nome fantasia
            $table->string('cpf_cnpj',20); //cpf ou cnpj
            $table->string('site')->nullable(); //site
            $table->string('phone',20)->nullable(); //telefone

            //endereço
            $table->string('cep',15)->nullable(); //cep
            $table->char('uf',2)->nullable(); //uf
            $table->string('address')->nullable(); //endereço/logradouro
            $table->integer('number')->nullable(); //numero
            $table->string('district',100)->nullable(); //bairro
            $table->string('complement',100)->nullable(); //complemento
            $table->unsignedBigInteger('city_id')->unsigned()->nullable(); //cidade
            $table->foreign('city_id')
                ->references('id')
                ->on('cities');

            //vinculo do usuário a empresa (caso o mesmo cadastre)
            $table->unsignedBigInteger('owner_id')->unsigned()->nullable(); //dono
            $table->foreign('owner_id')
                ->references('id')
                ->on('users');

            //colocar o tipo aqui
            $table->string('responsible',100)->nullable(); //responsavel
            $table->string('email')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('companies');
    }
}
