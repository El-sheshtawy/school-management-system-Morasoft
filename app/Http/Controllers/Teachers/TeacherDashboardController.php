<?php

namespace App\Http\Controllers\Teachers;

use App\Http\Controllers\Controller;
use App\Http\Requests\AttendanceReportRequest;
use App\Models\Attendence;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TeacherDashboardController extends Controller
{
    public Teacher  $teacherSections;
    public Student $teacherStudents;

    public function __construct(Teacher $teacherSections, Student $teacherStudents)
    {
        $this->teacherSections=$teacherSections;
        $this->teacherStudents=$teacherStudents;
    }

    public function getTeacherSections()
    {
        return Teacher::findOrFail(auth()->guard('teacher')->user()->id)->Sections()->pluck('section_id');
    }

    public function getTeacherStudents()
    {
        return Student::whereIn('section_id',$this->getTeacherSections())->get();
    }

    public function showTeacherDashboard():View
    {
        $teacherSectionsIDs = Teacher::findOrFail(auth()->guard('teacher')->user()->id)->Sections()->pluck('section_id');

        $data = [
            'teacherSectionsCount' => $teacherSectionsIDs->count(),
            'teacherStudentsCount' => Student::whereIn('section_id', $teacherSectionsIDs)->count(),
        ];
        return view('pages.Teachers.dashboard.dashboard', $data);
    }

    public function showTeacherStudents():View
    {
        $teacherSectionsIDs = Teacher::findOrFail(auth()->guard('teacher')->user()->id)->Sections()->pluck('section_id');
        $teacherStudents = Student::whereIn('section_id', $teacherSectionsIDs)->get();
        $students = Student::all();
        return view('pages.Teachers.dashboard.students_of_teacher',
            compact('teacherStudents', 'students'));
    }

    public function showTeacherSections():View
    {
        $teacherSections = Teacher::find(auth()->guard('teacher')->user()->id)->Sections()->get();
        return view('pages.Teachers.dashboard.sections_of_teacher', compact('teacherSections'));
    }

    public function attendance(Request $request):RedirectResponse
    {
        try {
            $date = date('Y-m-d');
            foreach ($request->attendences as $studentID => $attendence) {
                if ($attendence == 'presence') {
                    $attendence_status = true;

                } elseif ($attendence == 'absent') {
                    $attendence_status = false;

                }
                Attendence::updateOrCreate([
                    'student_id'=>$studentID,
                    'attendence_date'=>$date,
                ],
                [
                    'student_id' =>$studentID,
                    'grade_id' =>$request->grade_id,
                    'classroom_id' =>$request->classroom_id,
                    'section_id' => $request->section_id,
                    'teacher_id' => 1,
                    'attendence_date' =>$date,
                    'attendence_status' =>$attendence_status,
                ]);
            }
            toastr()->success(__('messages.success'));
            return redirect()->back();

        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function attendanceReport():View
    {
        $teacherStudents= $this->getTeacherStudents();
        return view('pages.Teachers.dashboard.attendance_report',compact('teacherStudents'));
    }

    public function attendanceSearch(AttendanceReportRequest $request):View
    {
        $teacherSections= $this->getTeacherSections();
        $teacherStudents= $this->getTeacherStudents();

        if($request->student_id==0) /* select all attendance of students */  {
            $attendance=Attendence::whereBetween('attendence_date',[$request->from,$request->to])->get();
            return view('pages.Teachers.dashboard.attendance_report'
                ,compact('attendance','teacherSections','teacherStudents'));
        } else {
            $attendance=Attendence::where('student_id',$request->student_id)->whereBetween('attendence_date',[$request->from,$request->to])->get();
            return view('pages.Teachers.dashboard.attendance_report'
                ,compact('attendance','teacherSections','teacherStudents'));
        }
    }
}
