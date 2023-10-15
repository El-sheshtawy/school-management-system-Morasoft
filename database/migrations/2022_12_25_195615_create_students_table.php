<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->date('Date_Birth');
            $table->string('academic_year');

            $table->unsignedbigInteger('gender_id');
            $table->foreign('gender_id')->references('id')->on('genders')->cascadeOnDelete();

            $table->unsignedbigInteger('nationalitie_id');
            $table->foreign('nationalitie_id')->references('id')->on('nationalities')->cascadeOnDelete();

            $table->unsignedbigInteger('blood_id');
            $table->foreign('blood_id')->references('id')->on('type__bloods')->cascadeOnDelete();

            $table->unsignedbigInteger('Grade_id');
            $table->foreign('Grade_id')->references('id')->on('grades')->cascadeOnDelete();

            $table->unsignedbigInteger('Classroom_id');
            $table->foreign('Classroom_id')->references('id')->on('Classrooms')->cascadeOnDelete();

            $table->bigInteger('section_id')->unsigned();
            $table->foreign('section_id')->references('id')->on('sections')->cascadeOnDelete();

            $table->bigInteger('parent_id')->unsigned();
            $table->foreign('parent_id')->references('id')->on('my__parents')->cascadeOnDelete();

            $table->softDeletes();

            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('students');
    }
};
