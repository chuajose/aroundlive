<?php

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
            $table->increments('id');
            $table->string('name', 255);
            $table->string('email', 255);
            $table->string('password', 255);
            $table->string('remember_token', 100)->nullable()->default(NULL);
            $table->nullableTimestamps();
        });

        Schema::table('conversations', function (Blueprint $table) {
            $table->foreign('user_id_fk')->references('id')->on('users')->onDelete('no action')->onUpdate('no action');
        });

        Schema::table('conversations_likes', function (Blueprint $table) {
            $table->foreign('user_id_fk')->references('id')->on('users')->onDelete('no action')->onUpdate('no action');
        });

        Schema::table('conversations_responses', function (Blueprint $table) {
            $table->foreign('user_id_fk')->references('id')->on('users')->onDelete('no action')->onUpdate('no action');
        });

        Schema::table('conversatons_responses_likes', function (Blueprint $table) {
            $table->foreign('user_id_fk')->references('id')->on('users')->onDelete('no action')->onUpdate('no action');
        });

        Schema::table('files', function (Blueprint $table) {
            $table->foreign('user_id_fk')->references('id')->on('users')->onDelete('no action')->onUpdate('no action');
        });

        Schema::table('messages', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('no action')->onUpdate('no action');
        });

        Schema::table('messages_recipients', function (Blueprint $table) {
            $table->foreign('recipient_id')->references('id')->on('users')->onDelete('no action')->onUpdate('no action');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('conversations', function (Blueprint $table) {
            $table->dropForeign(['user_id_fk']);
            $table->dropForeign(['user_id_fk']);
            $table->dropForeign(['user_id_fk']);
            $table->dropForeign(['user_id_fk']);
            $table->dropForeign(['user_id_fk']);
            $table->dropForeign(['user_id']);
            $table->dropForeign(['recipient_id']);
        });

        Schema::drop('users');
    }
}