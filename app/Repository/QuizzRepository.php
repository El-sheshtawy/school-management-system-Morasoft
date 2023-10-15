<?php

namespace App\Repository;

use App\Models\Grade;
use App\Models\Quizze;
use App\Models\Subject;
use App\Models\Teacher;
use Exception;
use Illuminate\Http\Request;

class QuizzRepository implements QuizzRepositoryInterface
{

    public function index()
    {
        $quizzes = Quizze::get();
        return view('pages.Quizzes.index', compact('quizzes'));
    }

    public function create()
    {
        $data=[
            'grades'=> Grade::all(),
            'subjects'=>Subject::all(),
            'teachers'=>Teacher::all(),
        ];
        return view('pages.Quizzes.create', $data);
    }

    public function store(Request $request)
    {
        try {
            Quizze::create([
                'name'=>['en' => $request->Name_en, 'ar' => $request->Name_ar],
                'subject_id'=>$request->subject_id,
                'grade_id'=>$request->Grade_id,
                'classroom_id'=>$request->Classroom_id,
                'section_id'=>$request->section_id,
                'teacher_id'=>$request->teacher_id,
            ]);
            toastr()->success(trans('messages.success'));
            return redirect()->route('Quizzes.create');
        }
        catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    public function edit(int $id)
    {
        $quizz = Quizze::findorFail($id);
        $data=[
            'grades'=> Grade::all(),
            'subjects'=>Subject::all(),
            'teachers'=>Teacher::all(),
        ];
        return view('pages.Quizzes.edit', $data, compact('quizz'));
    }

    public function update(Request $request)
    {
        try {
            $quizz = Quizze::findorFail($request->id);
            $quizz->update([
                    'name'=>['en' => $request->Name_en, 'ar' => $request->Name_ar],
                    'subject_id'=>$request->subject_id,
                    'grade_id'=>$request->Grade_id,
                    'classroom_id'=>$request->Classroom_id,
                    'section_id'=>$request->section_id,
                    'teacher_id'=>$request->teacher_id,
            ]);
            toastr()->success(trans('messages.Update'));
            return redirect()->route('Quizzes.index');
        } catch (Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    public function destroy(Request $request)
    {
        try {
            Quizze::destroy($request->id);
            toastr()->error(trans('messages.Delete'));
            return redirect()->back();
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
