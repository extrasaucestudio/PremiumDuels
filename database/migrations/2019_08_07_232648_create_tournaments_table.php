<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTournamentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tournaments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->text('body');
            $table->text('image');
            $table->string('state')->default('awaiting');   /// queue - played -- ended
            $table->integer('price')->default(0);
            $table->integer('elo_min')->default(0);
            $table->integer('elo_max')->default(0);
            $table->bigInteger('creator_id')->unsigned();
            $table->timestamps();
        });

        Schema::table('tournaments', function ($table) {

            $table->foreign('creator_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tournaments');
    }
}
