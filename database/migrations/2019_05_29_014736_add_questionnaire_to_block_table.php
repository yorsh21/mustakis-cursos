<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddQuestionnaireToBlockTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('blocks', function (Blueprint $table) {
            $table->string('questionnaire_id')->after('school_workshop_id');
        });

        /*Schema::table('block_grade_users', function (Blueprint $table) {
            $table->string('answer_id')->after('division_user_id');
        });*/
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('blocks', function (Blueprint $table) {
            $table->dropColumn('questionnaire_id');
        });

        /*Schema::table('block_grade_users', function (Blueprint $table) {
            $table->dropColumn('answer_id');
        });*/
    }
}
