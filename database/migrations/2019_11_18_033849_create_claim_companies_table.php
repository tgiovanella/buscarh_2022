<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClaimCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('claim_companies', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')
                ->references('id')
                ->on('users');

            $table->unsignedBigInteger('company_id')->nullable();
            $table->foreign('company_id')
                ->references('id')
                ->on('companies');

            $table->unsignedBigInteger('document_photo_file_id')->nullable();
            $table->foreign('document_photo_file_id')
                ->references('id')
                ->on('files')
                ->onDelete('set null');

            $table->unsignedBigInteger('cnh_rg_photo_file_id')->nullable();
            $table->foreign('cnh_rg_photo_file_id')
                ->references('id')
                ->on('files')
                ->onDelete('set null');



            $table->string('name')->nullable();
            $table->string('cpf')->nullable();
            $table->string('rg_cnh')->nullable();
            $table->string('cnpj')->nullable();
            $table->string('token')->nullable();

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
        Schema::dropIfExists('claim_companies');
    }
}
