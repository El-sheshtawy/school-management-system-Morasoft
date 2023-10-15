<?php

//Routes for Parent

use App\Http\Controllers\ParentDashboardController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;


Route::prefix(LaravelLocalization::setLocale())->group(function (){

    Route::get('/parent/dashboard',[ParentDashboardController::class,'showParentsDashboard'])
        ->name('parent.dashboard');

    Route::get('parents/student',[ParentDashboardController::class,'showSonsParents'])->name('parents.sons');

    Route::get('/parent/profile',[ParentDashboardController::class,'showParentsProfile'])
        ->name('parents-profile');

    Route::get('/sons-attendance',[ParentDashboardController::class,'showSonsAttendance'])
        ->name('sons.attendance');

    Route::post('/sons-attendance/search',[ParentDashboardController::class,'searchInAttendance'])
        ->name('attendance.search');

    Route::get('/son-results/{id}',[ParentDashboardController::class,'showSonsResults'])
        ->name('sons.results');

})->middleware(['localeSessionRedirect', 'localizationRedirect', 'localeViewPath','auth:parent']);


