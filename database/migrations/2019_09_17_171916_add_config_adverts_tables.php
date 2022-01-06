<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddConfigAdvertsTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('adverts', function (Blueprint $table) {
            //relacionamento com categoria
            $table->unsignedBigInteger('advert_configuration_id');
            $table->foreign('advert_configuration_id')->references('id')->on('advert_configurations');
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
            $table->dropForeign(['advert_configuration_id']);
            $table->dropColumn(['advert_configuration_id']);
        });
    }
}
