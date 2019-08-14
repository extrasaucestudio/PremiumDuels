<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('item_id')->unsigned();
            $table->boolean('from_school')->default(false);
            $table->timestamps();
        });

        Schema::table('user_items', function ($table) {

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('item_id')->references('id')->on('items');
        });

        Schema::table('users', function ($table) {

            $table->foreign('helmet')->references('id')->on('user_items');
            $table->foreign('armor')->references('id')->on('user_items');
            $table->foreign('gloves')->references('id')->on('user_items');
            $table->foreign('boots')->references('id')->on('user_items');
            $table->foreign('weapon')->references('id')->on('user_items');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_items');
    }
}
