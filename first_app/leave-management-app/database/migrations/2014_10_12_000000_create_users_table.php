<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->bigInteger('projectId')->unsigned()->index();
            $table->bigInteger('teamId')->unsigned()->index();
            $table->integer('maxLeaveDays');
            $table->integer('leaveDaysLeft');
            $table->enum('role', ['admin','project lead','team lead','member']);
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::table('users', function($table) {
            $table->foreign('projectId')->references('id')->on('projects');
            $table->foreign('teamId')->references('id')->on('teams');
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
