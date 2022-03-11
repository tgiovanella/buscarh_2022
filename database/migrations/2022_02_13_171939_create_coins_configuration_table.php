<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoinsConfigurationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        
        Schema::create('coins_configuration', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->float('price_coins')->unsigned()->nullable();
            $table->integer('price_quote')->unsigned()->nullable();
            $table->integer('amount_coins')->unsigned()->nullable();
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
        Schema::dropIfExists('coins_configuration');
    }
}
