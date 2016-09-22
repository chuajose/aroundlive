<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConversationsLikesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('conversations_likes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id_fk')->unsigned();
            $table->integer('conversation_id_fk');
            $table->timestamp('created_at')->nullable();

            $table->foreign('conversation_id_fk')->references('id')->on('conversations')->onDelete('no action')->onUpdate('no action');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('conversations_likes', function (Blueprint $table) {
            $table->dropForeign(['conversation_id_fk']);
        });

        Schema::drop('conversations_likes');
    }
}