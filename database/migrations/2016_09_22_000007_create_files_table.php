<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('files', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id_fk')->unsigned();
            $table->string('name', 155);
            $table->string('ext', 5);
            $table->string('file', 255);
            $table->string('route', 255);
            $table->nullableTimestamps();
        });

        Schema::table('conversations_files', function (Blueprint $table) {
            $table->foreign('file_id_fk')->references('id')->on('files')->onDelete('no action')->onUpdate('no action');
        });

        Schema::table('conversations_responses_files', function (Blueprint $table) {
            $table->foreign('file_id_fk')->references('id')->on('files')->onDelete('no action')->onUpdate('no action');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('conversations_files', function (Blueprint $table) {
            $table->dropForeign(['file_id_fk']);
            $table->dropForeign(['file_id_fk']);
        });

        Schema::drop('files');
    }
}