<?php

namespace App\Repository;

use Illuminate\Http\Request;

interface AttendanceRepositoryInterface
{
    public function index();

    public function show($id);

    public function store(Request $request);
}
