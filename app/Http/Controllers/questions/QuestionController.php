<?php

namespace App\Http\Controllers\questions;

use App\Http\Controllers\Controller;
use App\Repository\QuestionRepositoryInterface;
use Illuminate\Http\Request;

class QuestionController extends Controller
{

    protected QuestionRepositoryInterface $Question;

    public function __construct(QuestionRepositoryInterface $Question)
    {
        $this->Question =$Question;
    }

    public function index()
    {
        return $this->Question->index();
    }

    public function create()
    {
        return $this->Question->create();
    }

    public function store(Request $request)
    {
        return $this->Question->store($request);
    }

    public function edit($id)
    {
        return $this->Question->edit($id);
    }

    public function update(Request $request)
    {
        return $this->Question->update($request);
    }

    public function destroy(Request $request)
    {
        return $this->Question->destroy($request);
    }
}
