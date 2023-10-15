<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
    {
        Schema::create('fees', function (Blueprint $table) {
            $table->id();
            $table->string('title', 100);
            $table->decimal('amount',8,2);

            $table->unsignedBigInteger('Grade_id');
            $table->foreign('Grade_id')->references('id')->on('Grades')->cascadeOnDelete();

            $table->unsignedBigInteger('Classroom_id');
            $table->foreign('Classroom_id')->references('id')->on('Classrooms')->cascadeOnDelete();

            $table->string('description')->nullable();
            $table->string('year');
            $table->integer('Fee_type');
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('fees');
    }
};
