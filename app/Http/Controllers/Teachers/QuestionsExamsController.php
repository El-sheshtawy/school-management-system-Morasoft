<?php

namespace App\Http\Controllers\Teachers;

use App\Http\Controllers\Controller;
use App\Models\Question;
use App\Models\Quizze;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class QuestionsExamsController extends Controller
{
    public function index():View
    {
        $questions=Question::all();
        return view('pages.Teachers.dashboard.Quizzes.Questions.index',compact('questions'));
    }

    public function addQuestion(int $id):View
    {
        $allQuizzes=Quizze::all();
        $quizzes=Quizze::findOrFail($id);
        return view('pages.Teachers.dashboard.Quizzes.Questions.create',
            compact('quizzes','allQuizzes'));
    }

    public function store(Request $request)
    {
        Question::create([
            'title'=>$request->title,
            'answers'=>$request->answers,
            'right_answer'=>$request->right_answer,
            'score'=>$request->score,
            'quizze_id'=>$request->quizze_id,
        ]);
        toastr()->success(__('messages.success'));
        return redirect()->route('Questions.index');
    }


    public function show(int $id):View
    {
        $quizzes=Quizze::findOrFail($id);
        $questions=Question::where('quizze_id',$quizzes->id)->get();
        return view('pages.Teachers.dashboard.Quizzes.Questions.index'
            ,compact('quizzes','questions'));
    }

    public function edit(int $id):View
    {
        $question=Question::findOrFail($id);
        $quizzes=Quizze::all();
        return view('pages.Teachers.dashboard.Quizzes.Questions.edit'
            ,compact('question','quizzes'));
    }


    public function update(Request $request)
    {
        $question=Question::findOrFail($request->id);
        $quizzes=Quizze::where('id',$question->quizze_id)->first();
        $question->update([
            'title'=>$request->title,
            'answers'=>$request->answers,
            'right_answer'=>$request->right_answer,
            'score'=>$request->score,
            'quizze_id'=>$request->quizze_id,
        ]);
        toastr()->success(__('messages.success'));
        return redirect()->route('Questions.show',$quizzes->id);
    }


    public function destroy(Request $request):RedirectResponse
    {
        try {
            Question::destroy($request->id);
            toastr()->error(__('messages.error'));
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error'=>$e->getMessage()]);
        }

    }
}
