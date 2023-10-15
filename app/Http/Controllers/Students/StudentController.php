<?php

namespace App\Http\Controllers\Students;

use App\Http\Controllers\Controller;
use App\Repository\StudentRepositoryInterface;
use Illuminate\Http\Request;
use App\Http\Requests\Storestudent;

class StudentController extends Controller
{
    protected StudentRepositoryInterface $student;

    public function __construct(StudentRepositoryInterface $student)
    {
        $this->student=$student;
    }
    public function index()
    {
        return $this->student->getstudents();
    }

    public function create()
    {
        return $this->student->createstudent();
    }
    public function store(Storestudent $request)
    {
        return $this->student->storestudent($request);
    }

    public function show($id)
    {
        return $this->student->showstudent($id);
    }

    public function edit(int $id)
    {
        return $this->student->editstudent($id);
    }

    public function update(Request $request)
    {
        return $this->student->updatestudent($request);
    }

    public function destroy(Request $request)
    {
        return $this->student->deletestudent($request);
    }

    public function getClassrooms($id)
    {
        return $this->student->getClassrooms($id);

    }

    public function getSections(int $id)
    {
        return $this->student->getSections($id);
    }

    public function uploadAttachments(Request $request)
    {
        return $this->student->uploadstudentAttachments($request);
    }

    public function downloadAttachments($studentName, $fileName)
    {
        return $this->student->downloadstudentAttachments($studentName, $fileName);
    }

    public function deleteAttachment(Request $request)
    {
        return $this->student->deletestudentAttachment($request);
    }
}
