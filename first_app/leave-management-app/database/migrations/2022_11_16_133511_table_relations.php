<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TableRelations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('inquiries', function($table) {
            $table->foreign('employeeId')->references('id')->on('users');
        });

        Schema::table('users', function($table) {
            $table->foreign('projectId')->references('id')->on('projects');
            $table->foreign('teamId')->references('id')->on('teams'); //sve migracije stavit zadnje
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
