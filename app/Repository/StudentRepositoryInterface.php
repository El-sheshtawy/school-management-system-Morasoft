<?php

namespace App\Repository;


use App\Http\Requests\StoreStudent;
use Illuminate\Http\Request;
interface StudentRepositoryInterface
{
    public function createStudent();
    public function getClassrooms($id);
    public function getSections($id);
    public function storeStudent(StoreStudent $request);
    public function getStudents();
    public function editStudent($id);
    public function updateStudent(Request $request);
    public function deleteStudent(Request $request);
    public function showStudent($id);
    public function uploadStudentAttachments(Request $request);
    public function downloadStudentAttachments($studentName, $fileName);
    public function deleteStudentAttachment(Request $request);

}
