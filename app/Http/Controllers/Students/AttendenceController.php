<?php

namespace App\Http\Controllers\Students;

use App\Http\Controllers\Controller;
use App\Repository\AttendanceRepositoryInterface;
use Illuminate\Http\Request;

class AttendenceController extends Controller
{
    public AttendanceRepositoryInterface $attendence;

    public function __construct(AttendanceRepositoryInterface $attendence)
    {
      return  $this->attendence=$attendence;
    }

    public function index()
    {
        return $this->attendence->index();
    }

    public function store(Request $request)
    {
        return $this->attendence->store($request);
    }

    public function show($id)
    {
        return $this->attendence->show($id);
    }
}
