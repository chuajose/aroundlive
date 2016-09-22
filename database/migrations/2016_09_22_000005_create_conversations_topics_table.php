<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConversationsTopicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('conversations_topics', function (Blueprint $table) {
            $table->integer('id');
            $table->integer('topic_id_fk');
            $table->integer('conversation_id_fk');
            $table->nullableTimestamps();

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
        Schema::table('conversations_topics', function (Blueprint $table) {
            $table->dropForeign(['conversation_id_fk']);
        });

        Schema::drop('conversations_topics');
    }
}