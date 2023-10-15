<?php

namespace App\Http\Controllers\Teachers;

use App\Http\Controllers\Controller;
use App\Repository\ExamsRepositoryInterface;
use Illuminate\Http\Request;

class examsController extends Controller
{
    protected ExamsRepositoryInterface $exam;

    public function __construct(ExamsRepositoryInterface $exam)
    {
        $this->exam=$exam;
    }

    public function index()
    {
        return $this->exam->index();
    }

    public function create()
    {
        return $this->exam->create();
    }

    public function store(Request $request)
    {
        return $this->exam->store($request);
    }

    public function edit($id)
    {
        return $this->exam->edit($id);
    }

    public function update(Request $request)
    {
        return $this->exam->update($request);
    }

    public function destroy(Request $request)
    {
        return $this->exam->destroy($request);
    }
    public function showDegree(int $id)
    {
        return $this->exam->showQuizDegree($id);
    }
    public function repeatExam(Request $request)
    {
        return $this->exam->repeatExam($request);
    }
}
