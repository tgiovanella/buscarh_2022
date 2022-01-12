<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuotesRelationalshipsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quotes_subcategories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('quote_id')->unsigned()->nullable();
            $table->bigInteger('subcategory_id')->unsigned()->nullable();

            $table->foreign('quote_id')->references('id')->on('quotes')->onDelete('cascade');
            $table->foreign('subcategory_id')->references('id')->on('subcategories');
        });

        Schema::create('quotes_operation_cities', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('quote_id')->unsigned()->nullable();
            $table->bigInteger('city_id')->unsigned()->nullable();

            $table->foreign('quote_id')->references('id')->on('quotes')->onDelete('cascade');
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
        Schema::dropIfExists('quotes_subcategories');
        Schema::dropIfExists('quotes_operation_cities');
    }
}
