<?php

//Routes for student

use App\Http\Controllers\Students\StudentExamController;
use App\Http\Controllers\Students\StudentProfileController;
use App\Http\Controllers\Teachers\examsController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;


Route::prefix(LaravelLocalization::setLocale())->group(function (){
    Route::get('/student/dashboard', function () {
        return view('pages.Students.dashboard.dashboard');
    });

    Route::resource('student-exam',StudentExamController::class);

    Route::get('/student/exam/degree/{quizze_id}',[examsController::class,'showDegree'])->name('student.degree');

    Route::resource('student-profile',StudentProfileController::class);

})->middleware(['localeSessionRedirect', 'localizationRedirect', 'localeViewPath','auth:student']);


