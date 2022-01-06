<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldFileAndRemoveValueAdvertConfigurationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //banner de seleção
        Schema::table('advert_configurations', function (Blueprint $table) {
            // $table->unsignedBigInteger('file_id')->nullable();
            // $table->foreign('file_id')
            //     ->references('id')
            //     ->on('files')
            //     ->onDelete('set null');

            $table->smallInteger('position')->nullable()->change();


            $table->dropColumn(['value']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('advert_configurations', function (Blueprint $table) {
            //
            // $table->dropForeign(['file_id']);
            // $table->dropColumn(['file_id']);

            $table->decimal('value', 8, 2); //valor a ser pago no plano //mensal ou anual
            $table->smallInteger('position')->nullable(false)->change();
        });
    }
}
