<?php

use App\Http\Controllers\Teachers\examsController;
use App\Http\Controllers\Teachers\QuestionsExamsController;
use App\Http\Controllers\Teachers\TeacherProfileController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use App\Http\Controllers\Teachers\TeacherDashboardController;


Route::prefix(LaravelLocalization::setLocale())->group(function (){

    Route::get('/teacher/dashboard',[TeacherDashboardController::class,'showTeacherDashboard']);

    Route::get('/teacher/students',[TeacherDashboardController::class,'showTeacherStudents'])
        ->name('teacher.students.show');

    Route::get('/teacher/sections',[TeacherDashboardController::class,'showTeacherSections'])
        ->name('teacher.sections.show');

    Route::post('/attendance',[TeacherDashboardController::class,'attendance'])->name('attendance');

    Route::get('/attendance-report',[TeacherDashboardController::class,'attendanceReport'])
        ->name('attendance.report');

    Route::post('/attendance-search',[TeacherDashboardController::class,'attendanceSearch'])
        ->name('attendance-search');

    Route::resource('exams',examsController::class);

    Route::resource('Questions',QuestionsExamsController::class);
    Route::get('/add-Question/{id}',[QuestionsExamsController::class,'addQuestion'])->name('Question.add');

    Route::get('teacher/profile',[TeacherProfileController::class,'index'])->name('teacher.profile.index');
    Route::post('teacher/profile/update',[TeacherProfileController::class,'update'])->
    name('teacher.profile.update');

    Route::post('teacher/exam/repeat',[examsController::class,'repeatExam'])->name('exam.repeat');

})->middleware(['localeSessionRedirect', 'localizationRedirect', 'localeViewPath','auth:teacher']);

