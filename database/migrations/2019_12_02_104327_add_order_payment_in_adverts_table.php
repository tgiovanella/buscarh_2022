<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddOrderPaymentInAdvertsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('adverts', function (Blueprint $table) {

            $table->bigInteger('order_payment_id')->unsigned()->nullable();
            $table->foreign('order_payment_id')->references('id')->on('order_payments');
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
            $table->dropForeign(['order_payment_id']);
            $table->dropColumn(['order_payment_id']);
        });
    }
}
