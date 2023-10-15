<?php

namespace App\Http\Controllers\Students;

use App\Http\Controllers\Controller;
use App\Models\Quizze;
use App\Models\Student;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class StudentExamController extends Controller
{
    public function index():View
    {
        $student=Student::findOrFail(auth()->guard('student')->user()->id);
        $studentGradeID=$student->Grade_id;
        $studentClassroomID=$student->Classroom_id;
        $studentSectionID=$student->section_id;
        $teacherSectionID=DB::table('teacher_section')->
        where('section_id',$studentSectionID)->pluck('teacher_id');

        $quizzes=Quizze::where('grade_id',$studentGradeID)->where('classroom_id',$studentClassroomID)
            ->where('section_id',$studentSectionID)->where('teacher_id',$teacherSectionID)->get();

        return view('pages.Students.dashboard.exams.index',compact('quizzes'));
    }

    public function show($quizze_id)
    {
        $student_id=auth()->guard('student')->user()->id;
        return view('pages.Students.dashboard.exams.show',compact('student_id','quizze_id'));
    }

}
