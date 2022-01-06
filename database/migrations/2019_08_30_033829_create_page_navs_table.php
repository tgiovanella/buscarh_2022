<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePageNavsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('page_navs', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('name');
            $table->string('url');
            $table->string('slug')->nullable();

            //relacionamento com categoria
            $table->unsignedBigInteger('page_block_id');
            $table->foreign('page_block_id')->references('id')->on('page_blocks');

            $table->smallInteger('order')->default(0);
            $table->longText('observation')->nullable();
            $table->boolean('status')->default(true);


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
        Schema::dropIfExists('page_navs');
    }
}
