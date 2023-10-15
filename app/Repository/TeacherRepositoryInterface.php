<?php

namespace App\Repository;

use Illuminate\Http\Request;

interface TeacherRepositoryInterface
{
    public function getAllTeachers();
    public function getAllSpecializations();
    public function getAllGenders();
    public function storeTeacher(Request $request);
    public function editTeacher(int $id);
    public function updateTeacher(Request $request);
    public function deleteTeacher(Request $request);
}
