<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateFieldCpfCnpjCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('companies', function (Blueprint $table) {
            $table->string('fantasy')->nullable(true)->change(); //nome fantasia
            $table->string('cpf_cnpj',20)->nullable(true)->change(); //cpf ou cnpj
            $table->string('phone',100)->nullable()->change(); //telefone

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('companies', function (Blueprint $table) {
            $table->string('fantasy')->nullable(false)->change(); //nome fantasia
            $table->string('cpf_cnpj',20)->nullable(false)->change(); //cpf ou cnpj


        });
    }
}
