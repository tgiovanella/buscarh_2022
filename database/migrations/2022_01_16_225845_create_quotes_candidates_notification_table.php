<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuotesCandidatesNotificationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quote_candidate_notifications', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->bigInteger('quote_id')->unsigned()->nullable();
            $table->bigInteger('company_id')->unsigned()->nullable();
            $table->char('is_view', 1)->default(0);
            $table->char('is_pay', 1)->default(0); 

            $table->foreign('quote_id')->references('id')->on('quotes')->onDelete('cascade');
            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('quote_candidate_notifications');
    }
}
