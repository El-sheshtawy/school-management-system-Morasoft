<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('degrees', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->references('id')->on('students')->cascadeOnDelete();
            $table->foreignId('quizze_id')->references('id')->on('quizzes')->cascadeOnDelete();
            $table->foreignId('question_id')->references('id')->on('questions')->cascadeOnDelete();
            $table->float('score');
            $table->date('date');
            $table->enum('abuse',[0,1])->default(0);
            $table->timestamps();
        });
    }
   public function down()
    {
        Schema::dropIfExists('degrees');
    }
};
