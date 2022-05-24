<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCertificatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('certificates', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('background');
            $table->string('description', 1024)->nullable();
            $table->boolean('horizontal')->default(0);
            $table->date('date');

            $table->integer('user_top')->default(0);
            $table->integer('user_left')->default(0);
            $table->integer('user_width')->default(300);
            $table->integer('user_height')->default(40);

            $table->integer('description_top')->default(0);
            $table->integer('description_left')->default(0);
            $table->integer('description_width')->default(300);
            $table->integer('description_height')->default(40);

            $fields = ['nombre', 'email', 'rut', 'birth_date', 'genere', 'phone_number', 'address', 'course', 'commune', 'region', 'establishment',
                        'libre1', 'libre2', 'libre3', 'libre4', 'libre5', 'libre6', 'libre7', 'libre8', 'libre9', 'libre10'];


            $table->integer('date_top')->default(0);
            $table->integer('date_left')->default(0);
            $table->integer('date_width')->default(300);
            $table->integer('date_height')->default(40);

            $table->integer('user_size')->default(18);
            $table->integer('description_size')->default(18);
            $table->integer('date_size')->default(18);

            $table->string('user_color')->default("#000000");
            $table->string('description_color')->default("#000000");
            $table->string('date_color')->default("#000000");
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
        Schema::dropIfExists('certificates');
    }
}
