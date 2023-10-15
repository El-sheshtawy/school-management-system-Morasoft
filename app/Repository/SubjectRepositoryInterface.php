<?php

namespace App\Repository;

use Illuminate\Http\Request;

interface SubjectRepositoryInterface
{
    public function index();

    public function create();

    public function store(Request $request);

    public function edit(Request $id);

    public function update(Request $request);

    public function destroy(Request $request);
}
