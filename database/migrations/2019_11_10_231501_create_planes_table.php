<?php

use App\Plane;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlanesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('planes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name'); //nome do plano
            $table->string('reference'); //nome de referencia
            $table->string('code')->nullable(); //codigo para usar nas assinaturas
            $table->string('charge')->default('AUTO'); //AUTO ou MANUAL
            $table->string('period')->default(Plane::MONTHLY); //'MONTHLY', //WEEKLY, BIMONTHLY, TRIMONTHLY, SEMIANNUALLY, YEARLY
            $table->decimal('amount_per_payment'); //amountPerPayment
            $table->decimal('membership_free')->nullable()->default(0); //opcional - cobrado na primeira parcela
            $table->integer('trial_period_duration')->nullable()->default(0); //periodo de teste
            $table->string('details')->nullable(); //detalhes
            $table->boolean('status')->default(true); //detalhes
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
        Schema::dropIfExists('planes');
    }
}
