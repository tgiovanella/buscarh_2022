<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->bigIncrements('id');

            //tag
            $table->smallInteger('tag');
            $table->text('observation');
            $table->string('name');
            $table->string('cpf_cnpj');
            $table->string('email');
            $table->string('token');
            $table->boolean('is_valid')->default(false);

            $table->bigInteger('company_id')->unsigned()->nullable();
            $table->foreign('company_id')->references('id')->on('companies');

            $table->bigInteger('advert_id')->unsigned()->nullable();
            $table->foreign('advert_id')->references('id')->on('adverts');

            $table->smallInteger('status')->default(1);

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
        Schema::dropIfExists('reports');
    }
}
