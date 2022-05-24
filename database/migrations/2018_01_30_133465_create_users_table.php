<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('firstname');
            $table->string('lastname');
            $table->string('email');
            $table->string('rut');
            $table->string('password');
            $table->string('sha')->nullable();

            $table->date('birth_date')->nullable();
            $table->tinyInteger('genere')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('phone_number2')->nullable();
            $table->string('address')->nullable();
            $table->string('email_tutor')->nullable();
            $table->string('email_teacher')->nullable();
            $table->string('auth_doc')->nullable();
            $table->string('school_doc')->nullable();
            $table->string('course')->nullable();
            $table->string('cession_doc')->nullable();
            $table->string('license_student')->nullable();
            $table->string('license_tutor')->nullable();
            $table->string('recomendation_doc')->nullable();
            $table->string('doing_postulation')->nullable();
            $table->string('establishment')->nullable();
            $table->string('commune_establishment_student')->nullable();
            $table->string('dependency_establishment_student')->nullable();
            $table->string('type_establishment_student')->nullable();
            $table->string('especiality')->nullable();
            $table->tinyInteger('transport_establishment')->nullable();
            $table->string('phone_number_tutor')->nullable();
            $table->string('special_needs')->nullable();
            $table->string('needs_student')->nullable();
            $table->tinyInteger('participate_before_student')->nullable();
            $table->string('city_assist_workshop')->nullable();
            $table->string('workshop_puerto_montt')->nullable();
            $table->string('horary_preference')->nullable();
            $table->string('about_select_workshop',510)->nullable();
            $table->tinyInteger('establishment_workshop_robotic')->nullable();
            $table->string('first_contact_robotic')->nullable();
            $table->string('motivation')->nullable();
            $table->string('find_about_workshop')->nullable();
            $table->string('features_workshop')->nullable();
            $table->string('image_profile')->nullable();
            $table->tinyInteger('school_workshop')->nullable();
            $table->tinyInteger('participate_school_workshop')->nullable();
            $table->tinyInteger('participate_other_workshop')->nullable();
            $table->tinyInteger('participate_tournament_robotic')->nullable();
            $table->tinyInteger('robot_home')->nullable();
            $table->tinyInteger('knowledge_programation')->nullable();
            $table->string('experience_platform')->nullable();
            $table->string('broadcast_first_contact')->nullable();


            $table->unsignedInteger('commune_id')->nullable();
            $table->unsignedInteger('rol_id');
            $table->foreign('commune_id')->references('id')->on('communes');
            $table->foreign('rol_id')->references('id')->on('roles');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
