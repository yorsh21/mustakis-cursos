<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBlockGradeUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('block_grade_users', function (Blueprint $table) {
            $table->increments('id');
            $table->boolean('presence')->nullable();
            $table->integer('score')->nullable();
            $table->dateTime('specific_date')->nullable();
            $table->integer('block_grade_id')->unsigned();
            $table->integer('division_user_id')->unsigned();
            $table->foreign('block_grade_id')->references('id')->on('block_grades')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('division_user_id')->references('id')->on('division_users')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::drop('block_grade_users');
    }
}
