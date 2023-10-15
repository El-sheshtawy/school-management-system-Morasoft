<?php

namespace App\Repository;

use App\Http\Requests\FeeRequest;
use Illuminate\Http\Request;

interface FeesRepositoryInterface
{
    public function index();

    public function create();

    public function edit($id);

    public function store(FeeRequest $request);

    public function update(FeeRequest $request);

    public function destroy (Request $request);

    public function show($id);
}
