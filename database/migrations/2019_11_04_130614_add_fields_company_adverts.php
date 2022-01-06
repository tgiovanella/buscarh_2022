<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldsCompanyAdverts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('adverts', function (Blueprint $table) {
            $table->boolean('has_company')->default(false); //empresa s/n
            $table->string('email_payment')->nullable(); //email que vai ser enviado a cobrança (assinatura)
            $table->string('responsible_payment')->nullable(); //responsável pelo pagamento


            $table->unsignedBigInteger('subcategory_id')->unsigned()->nullable()->change(); //cate




            //vinculo do usuário a empresa (caso o mesmo cadastre)
            $table->unsignedBigInteger('company_id')->unsigned()->nullable(); //dono
            $table->foreign('company_id')
                ->references('id')
                ->on('companies');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('adverts', function (Blueprint $table) {
            $table->dropForeign(['company_id']);
            $table->dropColumn(['has_company','email_payment','responsible_payment','company_id']);
        });
    }
}
