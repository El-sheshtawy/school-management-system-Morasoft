<?php

namespace App\Repository;

use Illuminate\Http\Request;

interface QuizzRepositoryInterface
{
    public function index();

    public function create();

    public function store(Request $request);

    public function edit(int $id);

    public function update(Request $request);

    public function destroy(Request $request);
}
