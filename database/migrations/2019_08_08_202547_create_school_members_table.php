<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSchoolMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('school_members', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('school_id')->unsigned();
            $table->bigInteger('user_id')->unsigned();
            $table->timestamps();
        });

        Schema::table('school_members', function ($table) {
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('school_id')->references('id')->on('schools');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('school_members');
    }
}
