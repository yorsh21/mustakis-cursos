<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRequirementsToSchoolWorkshopsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('school_workshops', function (Blueprint $table) {
            $table->integer('requirement3_id')->unsigned()->nullable()->after('requirement_id');
            $table->integer('requirement2_id')->unsigned()->nullable()->after('requirement_id');

            $table->foreign('requirement2_id')->references('id')->on('school_workshops')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('requirement3_id')->references('id')->on('school_workshops')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('school_workshops', function (Blueprint $table) {
            $table->dropForeign(['requirement2_id']);
            $table->dropForeign(['requirement3_id']);

            $table->dropColumn('requirement2_id');
            $table->dropColumn('requirement3_id');
        });
    }
}
