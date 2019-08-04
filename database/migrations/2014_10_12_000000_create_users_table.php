<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {

            $table->bigIncrements('id');
            $table->string('name');
            $table->integer('uid')->unique();
            $table->integer('elo')->default(1500);
            $table->boolean('active')->default(false);
            $table->integer('kills')->default(0);
            $table->integer('deaths')->default(0);
            $table->string('country_code')->default('pl');
            $table->bigInteger('title_id')->unsigned()->default(1);
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('secret_key');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
