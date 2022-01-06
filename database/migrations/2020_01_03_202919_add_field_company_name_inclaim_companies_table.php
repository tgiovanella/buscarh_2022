<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldCompanyNameInclaimCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('claim_companies', function (Blueprint $table) {
            //
            $table->string('company')->nullable()->after('cnpj'); //nome da empresa
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('claim_companies', function (Blueprint $table) {
            $table->dropColumn(['company']);

        });
    }
}
