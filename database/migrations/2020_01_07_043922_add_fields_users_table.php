<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldsUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('phone',100)->nullable();
            $table->string('cpf',100)->nullable();
            $table->string('birth',100)->nullable();
            $table->string('street')->nullable();
            $table->string('number')->nullable();
            $table->string('complement')->nullable();
            $table->string('destrict')->nullable();
            $table->string('cep')->nullable();
            $table->string('city_name')->nullable();
            $table->string('uf')->nullable();

            $table->unsignedBigInteger('city_id')->unsigned()->nullable(); //cidade
            $table->foreign('city_id')
                ->references('id')
                ->on('cities');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {

            $table->dropForeign(['city_id']);
            $table->dropColumn(['city_id',
            'phone',
            'cpf',
            'birth',
            'street',
            'number',
            'complement',
            'destrict',
            'city_name',
            'uf',
            'cep']);
        });
    }
}
