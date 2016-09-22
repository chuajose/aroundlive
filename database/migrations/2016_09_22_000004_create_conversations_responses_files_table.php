<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConversationsResponsesFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('conversations_responses_files', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('conversation_response_id_fk');
            $table->integer('file_id_fk');

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
        Schema::table('conversations_responses_files', function (Blueprint $table) {
            $table->dropForeign(['conversation_response_id_fk']);
        });

        Schema::drop('conversations_responses_files');
    }
}