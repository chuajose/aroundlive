<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMessagesRecipientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages_recipients', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('recipient_id')->unsigned();
            $table->integer('message_id')->unsigned();
            $table->integer('is_read')->nullable();

            $table->foreign('message_id')->references('id')->on('messages')->onDelete('no action')->onUpdate('no action');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('messages_recipients', function (Blueprint $table) {
            $table->dropForeign(['message_id']);
        });

        Schema::drop('messages_recipients');
    }
}