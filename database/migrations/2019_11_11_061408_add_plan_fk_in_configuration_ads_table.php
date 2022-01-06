<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPlanFkInConfigurationAdsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('advert_configurations', function (Blueprint $table) {
            $table->bigInteger('plane_id')->unsigned()->nullable();
            $table->foreign('plane_id')->references('id')->on('planes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('advert_configurations', function (Blueprint $table) {
            $table->dropForeign(['plane_id']);
            $table->dropColumn(['plane_id']);
        });
    }
}
