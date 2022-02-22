<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCandidateBuyCoinsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('candidate_buy_coins', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('quote_id')->unsigned()->nullable();
            $table->bigInteger('company_id')->unsigned()->nullable();
            $table->integer('total_coins')->default(0);
            $table->integer('amount_coins')->default(0);
            $table->decimal('total_price')->default(0);
            $table->char('is_pay', 1)->default(0); 

            $table->foreign('quote_id')->references('id')->on('quotes')->onDelete('cascade');
            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
        });

        Schema::table('companies', function (Blueprint $table) {

            $table->integer('balance_coins')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumn('companies', 'balance_coins')) {
            Schema::table('companies', function (Blueprint $table) {
                $table->dropColumn('balance_coins');
            });
        }
        Schema::dropIfExists('candidate_buy_coins');
    }
}
