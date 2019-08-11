<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSchoolsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schools', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->integer('capacity')->default(5);
            $table->integer('elo')->default(0);
            $table->bigInteger('special_title_id')->nullable()->unsigned();
            $table->bigInteger('owner_id')->unsigned();
            $table->bigInteger('extra_gloves_id')->unsigned()->nullable();
            $table->bigInteger('extra_boots_id')->unsigned()->nullable();
            $table->text('body')->nullable();
            $table->timestamps();
        });

        Schema::table('schools', function ($table) {

            $table->foreign('owner_id')->references('id')->on('users');
            $table->foreign('special_title_id')->references('id')->on('special__titles');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('schools');
    }
}
