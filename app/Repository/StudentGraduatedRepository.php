<?php

namespace App\Repository;

use App\Models\Grade;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentGraduatedRepository implements StudentGraduatedRepositoryInterface
{
    public function index()
    {
        $students = Student::onlyTrashed()->get();
        return view('pages.Students.Graduated.index',compact('students'));
    }

    public function create()
    {
        $Grades=Grade::all();
        return view('pages.Students.Graduated.create',compact('Grades'));
    }

    public function softDelete(Request $request)
    {
        $students = student::where('Grade_id',$request->Grade_id)->where('Classroom_id',$request->Classroom_id)
            ->where('section_id',$request->section_id)->get();

        if($students->count() < 1){
            return redirect()->back()->with('error_Graduated', __('لاتوجد بيانات في جدول الطلاب'));
        } else {

            foreach ($students as $student){
                student::where('id', $student->id)->delete();
            }

            toastr()->success(__('messages.success'));
            return redirect()->route('Graduated.index');
        }
    }

    public function returnData(Request $request)
    {
        student::withTrashed()->where('id', $request->id)->first()->restore();
        toastr()->success(trans('messages.success'));
        return redirect()->back();
    }

    public function destroy(Request $request)
    {
        student::withTrashed()->where('id', $request->id)->first()->forceDelete();
        toastr()->error(trans('messages.Delete'));
        return redirect()->back();
    }
}
