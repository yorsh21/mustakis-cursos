<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFinishCourseToDivisionUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('division_users', function (Blueprint $table) {
            $table->double('attendance_percentage')->default(0);
            $table->boolean('approve')->default(0);
            $table->string('binnacle', 4096)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('division_users', function (Blueprint $table) {
            $table->dropColumn('attendance_percentage');
            $table->dropColumn('approve');
            $table->dropColumn('binnacle');
        });
    }
}
