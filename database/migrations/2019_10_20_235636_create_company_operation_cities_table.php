<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompanyOperationCitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_operation_cities', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->bigInteger('company_id')->unsigned()->nullable();
            $table->bigInteger('city_id')->unsigned()->nullable();

            $table->unique(['company_id', 'city_id']);

            $table->foreign('company_id')->references('id')->on('companies');
            $table->foreign('city_id')->references('id')->on('cities');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('company_operation_cities');
    }
}
