<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateFileFieldAdvertsTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('adverts', function (Blueprint $table) {

            $table->unsignedBigInteger('file_id')->nullable()->change();
            $table->dropForeign(['file_id']);
            $table->foreign('file_id')
                ->references('id')
                ->on('files')
                ->onDelete('set null');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('adverts', function (Blueprint $table) {


            $table->dropForeign(['file_id']);
            $table->foreign('file_id')->references('id')->on('files');

        });
    }
}
