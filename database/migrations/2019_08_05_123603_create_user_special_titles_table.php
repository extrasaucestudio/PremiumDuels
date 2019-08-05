<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserSpecialTitlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_special_titles', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->bigInteger('special_title_id')->unsigned();
            $table->bigInteger('user_id')->unsigned();
            $table->timestamps();
        });

        Schema::table('user_special_titles', function ($table) {

            $table->foreign('user_id')->references('id')->on('users');
        });

        Schema::table('user_special_titles', function ($table) {

            $table->foreign('special_title_id')->references('id')->on('special__titles');
        });

        Schema::table('users', function ($table) {

            $table->foreign('special_title_id')->references('id')->on('user_special_titles');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_special_titles');
    }
}
