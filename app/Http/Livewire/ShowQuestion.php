<?php

namespace App\Http\Livewire;

use App\Models\Degree;
use App\Models\Question;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\View;
use Livewire\Component;

class ShowQuestion extends Component
{
    public int $counter = 0;
    public int $quizze_id;
    public int $student_id;
    public Collection $data;
    public int $questionsCount;

    public function render(): View
    {
        $this->data = Question::where('quizze_id', $this->quizze_id)->get();
        $this->questionsCount = $this->data->count();
        return view('livewire.show-question', [$this->data, $this->questionsCount]);
    }

    public function nextQuestion(int $question_id, int $score, string $answer, string $right_answer)
    {
        $studentDegree = Degree::where('student_id', $this->student_id)->where('quizze_id', $this->quizze_id)->first();

        if (is_null($studentDegree)) {
            Degree::create([
                'quizze_id' => $this->quizze_id,
                'student_id' => $this->student_id,
                'question_id' => $question_id,
                'score' => (strcmp(trim($answer), trim($right_answer)) === 0) ? +$score : 0,
                'date' => date('Y-m-d'),
            ]);
        } else{
            if($studentDegree->question_id>=$this->data[$this->counter]->id){
                $studentDegree->update([
                    'score' =>0 ,
                    'abuse'=>'1',
                ]);
                toastr()->error('The Exam has been canceled because page is refreshed');
                return redirect()->route('student-exam.index');

            } else {
                $studentDegree->update([
                    'question_id' => $question_id,
                    'score' => (strcmp(trim($answer), trim($right_answer)) === 0) ?
                        $studentDegree->score += $score : $studentDegree->score = 0
                ]);
            }
        }

        if ($this->counter < $this->questionsCount - 1){
            $this->counter ++;
        } else {
            toastr()->success('The exam has been finished , Best wishes');
            return redirect()->route('student-exam.index');
        }
    }
}

