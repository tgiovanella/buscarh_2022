<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdvertConfigurationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('advert_configurations', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('title')->nullable(); //algum titulo

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

            $table->smallInteger('amount')->default(0); //quantidade a ser mostrada (quando status ativo)

            $table->decimal('value', 8, 2); //valor a ser pago no plano //mensal ou anual

            //tamanho da imagem que será feito o upload
            $table->smallInteger('width')->nullable();
            $table->smallInteger('height')->nullable();

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
        Schema::dropIfExists('advert_configurations');
    }
}
