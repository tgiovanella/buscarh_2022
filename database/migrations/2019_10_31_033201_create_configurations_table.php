<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConfigurationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('configurations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->unique();
            $table->string('value');
            $table->char('type')->default('S'); //S = String ; I = Inteiro ; A = Array;
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
        Schema::dropIfExists('configurations');
    }
}

//rodar no tinker

/***
 *
 *
 * App\Configuration::create(['name'=>'endereco','value'=>'Rua teste','type'=>'S']);
 */


// App\Configuration::create(['name'=>'endereco','value'=>'Rua Marcos de Teste, 199 - Centro - Varginha/MG']);
// App\Configuration::create(['name'=>'telefone','value'=>'(35) 99886-1001']);
// App\Configuration::create(['name'=>'email','value'=>'email@teste.com.br']);
// App\Configuration::create(['name'=>'site_name','value'=>'Busca RH']);
