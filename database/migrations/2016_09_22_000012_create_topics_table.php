<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTopicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('topics', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 45)->nullable();
            $table->nullableTimestamps();
        });

        Schema::table('conversations_topics', function (Blueprint $table) {
            $table->foreign('topic_id_fk')->references('id')->on('topics')->onDelete('no action')->onUpdate('no action');
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
            $table->dropForeign(['topic_id_fk']);
        });

        Schema::drop('topics');
    }
}