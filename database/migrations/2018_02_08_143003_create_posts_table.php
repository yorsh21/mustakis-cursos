<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->nullable();
            $table->text('body')->nullable();
            $table->string('forum')->nullable();
            $table->integer('division_user_id')->unsigned();
            $table->integer('parent_id')->unsigned()->nullable();
            $table->integer('grade_id')->unsigned();
            $table->foreign('division_user_id')->references('id')->on('division_users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('parent_id')->references('id')->on('posts')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('grade_id')->references('id')->on('grades')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('posts');
    }
}
