<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdvertsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('adverts', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('title', 100); //título do anuncio
            $table->longText('description')->nullable(); //alguma descrição ou observação

            $table->smallInteger('type'); //tipo do anuncio
            //1 - slide com logo
            //2 - nuvem de logo
            //3 - Banners full por categoria
            //4 - Banner a direita

            $table->smallInteger('position');
            //1 - top
            //2 - left
            //3 - right
            //4 - bottom

            $table->smallInteger('status')->default(App\Advert::STATUS_PENDING);
            //1 - PENDENTE
            //2 - APROVADO
            //3 - CANCELADO
            //4 - VENCIDO

            //relacionamento com categoria
            $table->unsignedBigInteger('subcategory_id');
            $table->foreign('subcategory_id')->references('id')->on('subcategories');

            $table->string('site')->nullable();




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
        Schema::dropIfExists('adverts');
    }
}
