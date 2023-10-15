<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('sections', function (Blueprint $table) {
            $table->id();
            $table->string('Name_Section');
            $table->integer('Status');

            $table->unsignedBigInteger('Grade_id');
            $table->foreign('Grade_id')->references('id')->on('grades')->
            cascadeOnUpdate()->cascadeOnUpdate();

            $table->unsignedBigInteger('Class_id');
            $table->foreign('Class_id')->references('id')->on('classrooms')->
            cascadeOnUpdate()->cascadeOnUpdate();

            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('sections');
    }
};
