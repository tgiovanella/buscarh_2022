<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompanyClicksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('company_clicks');
        Schema::create('company_clicks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('letter_state')->nullable();
            $table->integer('iso_state')->nullable();
            $table->string('city_name')->nullable();
            $table->string('company_name')->nullable();
            $table->bigInteger('company_id')->unsigned()->nullable();
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
        Schema::dropIfExists('company_clicks');
    }
}
