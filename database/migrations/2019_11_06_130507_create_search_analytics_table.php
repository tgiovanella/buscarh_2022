<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSearchAnalyticsTable extends Migration
{
    /**
     * Run the migrations. https://github.com/jenssegers/agent
     *
     * @return void
     */
    public function up()
    {
        Schema::create('search_analytics', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('term');

            $table->string('languages')->nullable(); // ['nl-nl', 'nl', 'en-us', 'en']
            $table->string('device')->nullable(); //Get the device name, if mobile. (iPhone, Nexus, AsusTablet, ...)
            $table->string('platform')->nullable(); //Get the operating system. (Ubuntu, Windows, OS X, ...)
            $table->string('browser')->nullable(); //Get the browser name. (Chrome, IE, Safari, Firefox, ...)
            $table->string('version_browser')->nullable();  ////Get the browser name. (Chrome, IE, Safari, Firefox, ...)
            $table->boolean('is_desktop')->default(true); //verifica se é desktop
            $table->string('remote_addr')->nullable();
            $table->string('url')->nullable();

            $table->bigInteger('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')->on('users');

            $table->string('token')->index()->unique();

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
        Schema::dropIfExists('search_analytics');
    }
}
