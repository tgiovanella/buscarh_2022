<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompanyOperationStatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_operation_states', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->bigInteger('company_id')->unsigned()->nullable();
            $table->bigInteger('state_id')->unsigned()->nullable();

            $table->unique(['company_id', 'state_id']);

            $table->foreign('company_id')->references('id')->on('companies');
            $table->foreign('state_id')->references('id')->on('states');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('company_operation_states');
    }
}
