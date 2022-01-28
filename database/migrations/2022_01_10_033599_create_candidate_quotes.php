<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCandidateQuotes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('candidate_quotes', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->bigInteger('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')->on('users');

            $table->bigInteger('company_id')->unsigned()->nullable(); // caso use id da empresa no lugar do usuario
            $table->foreign('company_id')->references('id')->on('companies');

            $table->bigInteger('quote_id')->unsigned()->nullable();
            $table->foreign('quote_id')->references('id')->on('quotes');

            $table->float('price');
            $table->text('comment');

            $table->dateTime('deadline');
            $table->boolean('taxes')->default(true); //detalhes
            $table->boolean('expenditure')->default(true); //detalhes

            $table->string('path_file')->nullable();
            $table->string('accepted_proposal')->nullable();

            // $table->bigInteger('city_id')->unsigned()->nullable();
            // $table->foreign('city_id')->references('id')->on('cities');

            // $table->bigInteger('user_id')->unsigned()->nullable();
            // $table->foreign('user_id')->references('id')->on('users');

            // $table->decimal('price', 4, 2)->nullable();

            // $table->bigInteger('city_id')->unsigned()->nullable();

            // $table->boolean('taxes')->default(true); //detalhes
            // $table->boolean('expenditure')->default(true); //detalhes

            // $table->text('comment')->nullable();
            // $table->string('path_file')->nullable();
            // $table->dateTime('deadline')->nullable();
            // $table->string('accepted_proposal')->nullable();

            //'plan_id', 'status', 'subscribed_at', 'expired_at', 'trial_expired_at'

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
        Schema::dropIfExists('candidate_quotes');
    }
}
