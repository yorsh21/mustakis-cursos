<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSchoolWorkshopCampusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('school_workshop_campus', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('campus_id')->unsigned();
            $table->integer('school_workshop_id')->unsigned();
            $table->foreign('campus_id')->references('id')->on('campus')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('school_workshop_id')->references('id')->on('school_workshops')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::drop('school_workshop_campus');
    }
}
