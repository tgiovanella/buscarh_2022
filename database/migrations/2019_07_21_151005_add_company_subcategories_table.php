<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCompanySubcategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_subcategories', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->bigInteger('company_id')->unsigned()->nullable();
            $table->bigInteger('subcategory_id')->unsigned()->nullable();

            $table->unique(['company_id', 'subcategory_id']);

            $table->foreign('company_id')->references('id')->on('companies');
            $table->foreign('subcategory_id')->references('id')->on('subcategories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('company_subcategories');
    }
}
