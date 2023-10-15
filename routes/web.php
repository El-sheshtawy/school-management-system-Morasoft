<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Classrooms\ClassroomController;
use App\Http\Controllers\Exams\ExamController;
use App\Http\Controllers\Grades\GradeController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PersonalInfoController;
use App\Http\Controllers\Questions\QuestionController;
use App\Http\Controllers\Quizzes\QuizzController;
use App\Http\Controllers\Sections\SectionController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\Students\AttendenceController;
use App\Http\Controllers\Students\FeeInvoiceController;
use App\Http\Controllers\Students\FeesController;
use App\Http\Controllers\Students\GraduatedController;
use App\Http\Controllers\Students\LibraryController;
use App\Http\Controllers\Students\PaymentController;
use App\Http\Controllers\Students\ProcessingFeeController;
use App\Http\Controllers\Students\PromotionController;
use App\Http\Controllers\Students\ReceiptStudentsController;
use App\Http\Controllers\Students\StudentController;
use App\Http\Controllers\Subjects\SubjectController;
use App\Http\Controllers\Teachers\TeacherController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

//customize login page.
Route::get('/',[HomeController::class,'index'])->name('selection');

//login form and validate login
Route::get('/login/{type}',[LoginController::class,'loginForm'])->middleware('guest')->
    name('login.show');
Route::post('/login',[LoginController::class,'login'])->name('login');
Route::get('/logout/{type}',[LoginController::class,'logout'])->name('logout');


Route::prefix( LaravelLocalization::setLocale())->group(function()
{
    Route::get('/dashboard',function ()
    {
        return view('dashboard');
    });

    Route::resource('Grades', GradeController::class);

    Route::resource('Classrooms', ClassroomController::class);

    Route::post('/Filter_Classes', [ClassroomController::class ,'filterClasses'])->name('Filter_Classes');

    Route::post('/delete_all', [ClassroomController::class ,'deleteAll'])->name('delete_all');

    Route::resource('Sections',SectionController::class);

    Route::get('/classes/{id}',[SectionController::class,'getClasses']);

    Route::view('add_parent','livewire.show_Form')->name('add_parent');

    Route::resource('Teachers',TeacherController::class);

    Route::resource('Students',StudentController::class);

    Route::get('/Get_classrooms/{id}', [StudentController::class,'getClassrooms']);

    Route::get('/Get_Sections/{id}', [StudentController::class,'getSections']);

    Route::post('/Upload_attachment', [StudentController::class,'uploadStudentAttachments'])->
    name('Upload_attachment');

    Route::get('/Download_attachment/{studentName}/{fileName}', [StudentController::class,'downloadAttachments'])
        ->name('Download_attachment');

    Route::post('/Delete_attachment', [StudentController::class,'deleteAttachment'])->name('Delete_attachment');

    Route::resource('Promotion',PromotionController::class);

    Route::resource('Graduated', GraduatedController::class);

    Route::resource('Fees',FeesController::class);

    Route::resource('Fees_Invoices', FeeInvoiceController::class);

    Route::resource('receipt_students', ReceiptStudentsController::class);

    Route::resource('ProcessingFee', ProcessingFeeController::class);

    Route::resource('Payment_students', PaymentController::class);

    Route::resource('Attendance', AttendenceController::class);

    Route::resource('subjects',SubjectController::class);

    Route::resource('Exams', ExamController::class);

    Route::resource('library',LibraryController::class);

    Route::resource('questions',QuestionController::class);

    Route::resource('Quizzes',QuizzController::class);

    Route::resource('settings', SettingController::class);

    Route::get('show-personal-info',[PersonalInfoController::class,'show'])->name('personalInfo.show');

    Route::patch('personal-info',[PersonalInfoController::class,'update'])->name('personalInfo.update');

})->middleware(['localeSessionRedirect', 'localizationRedirect', 'localeViewPath','auth']);

