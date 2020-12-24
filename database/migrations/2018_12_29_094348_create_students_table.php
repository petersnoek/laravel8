<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->increments('id');

            $table->string('voornaam');
            $table->string('tussenvoegsel')->nullable();
            $table->string('achternaam');
            $table->string('email')->unique()->nullable();
            $table->string('email_school')->unique()->nullable();
            $table->string('mobiel')->nullable();
            $table->string('telefoon_thuis')->nullable();
            $table->string('straat')->nullable();
            $table->integer('huisnummer')->nullable();
            $table->string('toevoeging')->nullable();
            $table->string('postcode')->nullable();
            $table->string('plaats')->nullable();
            $table->string('land')->nullable();
            $table->string('photo_url')->nullable();

            $table->string('student_code')->nullable();

            $table->boolean('active')->default(true);
            $table->bigInteger('created_by');
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
        Schema::dropIfExists('students');
    }
}
