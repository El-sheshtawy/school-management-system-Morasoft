<?php

namespace App\Repository;

use Illuminate\Http\Request;

interface ExamsRepositoryInterface
{
    public function index();
    public function create();
    public function store(Request $request);
    public function edit(int $id);
    public function update(Request $request);
    public function destroy(Request $request);
    public function showQuizDegree(int $id);
    public function repeatExam(Request $request);
}
