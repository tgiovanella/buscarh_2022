<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuotesNps extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quotes_nps', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->bigInteger('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')->on('users');

            $table->bigInteger('quote_id')->unsigned()->nullable();
            $table->foreign('quote_id')->references('id')->on('quotes');

            $table->bigInteger('company_id')->unsigned()->nullable();
            $table->foreign('company_id')->references('id')->on('companies');

            $table->text('comment')->nullable();
            $table->char('answer', 1)->default(0);



            $table->timestamps();
        });

        Schema::table('candidate_quotes', function (Blueprint $table) {
            
            $table->char('nps_answer', 1)->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumn('candidate_quotes', 'nps_answer')) {
            Schema::table('candidate_quotes', function (Blueprint $table) {
                $table->dropColumn('nps_answer');
            });
        }
        Schema::dropIfExists('quotes_nps');
    }
}
