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
            $table->integer('elo')->default(1000);
            $table->boolean('active')->default(false);
            $table->integer('kills')->default(0);
            $table->integer('deaths')->default(0);
            $table->bigInteger('country_id')->nullable()->unsigned();
            $table->string('ip')->nullable();
            $table->bigInteger('title_id')->unsigned()->default(1);
            $table->bigInteger('special_title_id')->nullable()->unsigned();
            $table->boolean('golden_account')->default(false);
            $table->boolean('admin')->default(false);
            $table->integer('currency')->default(0);
            $table->boolean('hidePass')->default(0);
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('secret_key');
            $table->bigInteger('helmet')->nullable()->unsigned();
            $table->bigInteger('armor')->nullable()->unsigned();
            $table->bigInteger('gloves')->nullable()->unsigned();
            $table->bigInteger('boots')->nullable()->unsigned();
            $table->bigInteger('weapon')->nullable()->unsigned();
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
