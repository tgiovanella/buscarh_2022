<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_payments', function (Blueprint $table) {
            $table->bigIncrements('id');


            $table->bigInteger('plane_id')->unsigned()->nullable();
            $table->foreign('plane_id')->references('id')->on('planes');


            $table->bigInteger('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')->on('users');


            $table->bigInteger('company_id')->unsigned()->nullable();
            $table->foreign('company_id')->references('id')->on('companies');

            //'plan_id', 'status', 'subscribed_at', 'expired_at', 'trial_expired_at'
            $table->string('status')->nullable(); //
            $table->dateTime('subscribed_at')->nullable();
            $table->dateTime('expired_at')->nullable();
            $table->dateTime('trial_expired_at')->nullable();

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
        Schema::dropIfExists('order_payments');
    }
}
