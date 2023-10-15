<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('teachers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->text('Address');
            $table->date('Joining_Date');

            $table->unsignedbigInteger('Specialization_id');
            $table->foreign('Specialization_id')->references('id')->
            on('specializations')->cascadeOnDelete()->cascadeOnDelete();

            $table->unsignedbigInteger('Gender_id');
            $table->foreign('Gender_id')->references('id')->
            on('genders')->cascadeOnDelete()->cascadeOnUpdate();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('teachers');
    }
};
