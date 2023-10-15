<?php

namespace App\Repository;

use App\Models\Degree;
use App\Models\Grade;
use App\Models\Quizze;
use App\Models\Subject;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ExamsRepository implements ExamsRepositoryInterface
{
    public function index():View
    {
        $quizzes=Quizze::where('teacher_id',auth()->guard('teacher')->user()->id)->get();
        return view('pages.Teachers.dashboard.Quizzes.index',compact('quizzes'));
    }
    public function create():View
    {
        $data=[
            'subjects'=>Subject::where('teacher_id',auth()->guard('teacher')->user()->id)->get(),
            'grades'=>Grade::all(),
        ];
        return view('pages.Teachers.dashboard.Quizzes.create',$data);
    }
    public function store(Request $request)
    {
        Quizze::create([
            'name'=>['ar'=>$request->Name_ar,'en'=>$request->Name_en],
            'subject_id'=>$request->subject_id,
            'grade_id'=>$request->Grade_id,
            'classroom_id'=>$request->Classroom_id,
            'section_id'=>$request->section_id,
            'teacher_id'=>auth()->guard('teacher')->user()->id,
        ]);
        toastr()->success('messages.success');
        return redirect()->back();
    }

    public function edit(int $id):view
    {
        $data=[
            'quizz'=>Quizze::findOrFail($id),
            'subjects'=>Subject::all(),
            'teachers'=>Teacher::all(),
            'grades'=>Grade::all(),
        ];
        return view('pages.Teachers.dashboard.Quizzes.edit',$data);
    }
    public function update(Request $request)
    {
        $quizz=Quizze::findOrFail($request->id);
        $quizz->update([
            'name'=>['ar'=>trim($request->Name_ar),'en'=>$request->Name_en],
            'subject_id'=>$request->subject_id,
            'grade_id'=>$request->Grade_id,
            'classroom_id'=>$request->Classroom_id,
            'section_id'=>$request->section_id,
            'teacher_id'=>auth()->guard('teacher')->user()->id,
        ]);
        toastr()->success('messages.success');
        return redirect()->route('exams.index');
    }
    public function destroy(Request $request)
    {
        try {
            Quizze::destroy($request->id);
            toastr()->error(__('messages.error'));
            return redirect()->back();
        } catch (\Exception $e){
            return redirect()->back()->withErrors(['error'=>$e->getMessage()]);
        }
    }

    public function showQuizDegree(int $quizze_id)
    {
        $degrees= Degree::where('quizze_id',$quizze_id)->get();
        return view('pages.Teachers.dashboard.Quizzes.student_quiz',
            compact('quizze_id','degrees'));
    }

    public function repeatExam(Request $request)
    {
        Degree::where('student_id',$request->student_id)->where('quizze_id',$request->quizze_id)->delete();
        toastr()->success('The Exam has been opened');
        return redirect()->back();
    }
}
