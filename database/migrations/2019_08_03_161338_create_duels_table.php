<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDuelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('duels', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('winner_id')->unsigned();
            $table->bigInteger('loser_id')->unsigned();
            $table->timestamps();
        });

        Schema::table('duels', function ($table) {

            $table->foreign('winner_id')->references('id')->on('users');
            $table->foreign('loser_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('duels');
    }
}
