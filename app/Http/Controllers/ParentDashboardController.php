<?php

namespace App\Http\Controllers;

use App\Models\Attendence;
use App\Models\Degree;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ParentDashboardController extends Controller
{
    public function showParentsDashboard():View
    {
        $sons=Student::all()->where('parent_id',auth()->guard('parent')->user()->id);
        return view('pages.parents.dashboard',compact('sons'));
    }

    public function showSonsParents(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $students=Student::all()->where('parent_id',auth()->guard('parent')->user()->id);
        return view('pages.parents.sons.index',compact('students'));
    }

    public function showSonsResults(Request $request): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse
    {
        $student=Student::findOrFail($request->id);
        if($student->parent_id === auth()->guard('parent')->user()->id) {
            $degrees=Degree::all()->where('student_id',$student->id);

            if(count($degrees)==0){
                return redirect()->route('parents.sons')->with(['empty'=>'No results to show for '.$student->name]);
            } else {
                return view('pages.parents.results.index',compact('degrees'));
            }
        } else{
            toastr()->error('messages.error');
            return redirect()->route('parents.sons');
        }
    }

    public function showSonsAttendance(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $students=Student::all()->where('parent_id',auth()->guard('parent')->user()->id);
        $studentsIDs=Student::all()->where('parent_id',auth()->guard('parent')->user()->id)->
        pluck('id');
        $studentsAttendance=Attendence::all()->whereIn('student_id',$studentsIDs);
        return view('pages.parents.attendance',compact('students','studentsAttendance'));
    }

    public function searchInAttendance(Request $request):View
    {
       $request->validate([
           'from'=>'required|date|date_format:Y-m-d',
           'to'=>'required|date|date_format:Y-m-d|after_or_equal:from',
       ],[
           'form.required'=>'This field must not be empty',
           'from.date'=>'The format of date must be date',
           'from.date_format'=>'The format of date must be in Y-m-d',
           'to.required'=>'This field must not be empty',
           'to.date'=>'The format of date must be date',
           'to.date_format'=>'The format of date must be in Y-m-d',
           'to.after_or_equal'=>'The field to must be equal or after from field'
       ]);
        $students=Student::all()->where('parent_id',auth()->guard('parent')->user()->id);
       if ($request->student_id==0)
       {
           $studentsAttendance=Attendence::all()->whereBetween('attendence_date',[$request->from,$request->to]);
           return view('pages.parents.attendance',compact('studentsAttendance','students'));
       } else {
           $studentsAttendance=Attendence::all()->where('student_id',$request->student_id)->
           whereBetween('attendence_date',[$request->from,$request->to]);
           return view('pages.parents.attendance',compact('studentsAttendance','students'));
       }
    }

    public function showParentsProfile()
    {
        //
    }
}
