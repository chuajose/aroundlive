<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConversatonsResponsesLikesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('conversatons_responses_likes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('conversation_response_id_fk');
            $table->integer('user_id_fk')->unsigned();
            $table->timestamp('created_at')->nullable();

            $table->foreign('conversation_response_id_fk')->references('id')->on('conversations_responses')->onDelete('no action')->onUpdate('no action');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('conversatons_responses_likes', function (Blueprint $table) {
            $table->dropForeign(['conversation_response_id_fk']);
        });

        Schema::drop('conversatons_responses_likes');
    }
}