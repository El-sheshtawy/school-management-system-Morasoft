<?php

namespace App\Http\Controllers\Teachers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repository\TeacherRepositoryInterface;


class TeacherController extends Controller
{
    protected TeacherRepositoryInterface $teacher;

    public function __construct(TeacherRepositoryInterface $teacher)
    {
        $this->teacher=$teacher;
    }
    public function index()
    {
        $Teachers=$this->teacher->getAllTeachers();
        return view('Pages.Teachers.Teachers',compact('Teachers'));
    }

    public function create()
    {
        $specializations=$this->teacher->getAllSpecializations();
        $genders=$this->teacher->getAllGenders();
        return view('Pages.Teachers.create',compact('specializations','genders'));
    }

    public function store(Request $request)
    {
        return $this->teacher->storeTeacher($request);
    }

    public function edit($id)
    {
        $Teachers= $this->teacher->editTeacher($id);
        $specializations=$this->teacher->getAllSpecializations();
        $genders=$this->teacher->getAllGenders();
        return view('Pages.Teachers.edit',compact('Teachers','specializations','genders'));

    }

    public function update(Request $request)
    {
        return $this->teacher->updateTeacher($request);
    }

    public function destroy(Request $request)
    {
       return $this->teacher->deleteTeacher($request);
    }
}
