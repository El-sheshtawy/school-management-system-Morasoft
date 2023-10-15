<?php

namespace App\Repository;

use Illuminate\Http\Request;

interface StudentGraduatedRepositoryInterface
{
    public function index();
    public function create();
    public function softDelete(Request $request);
    public function returnData(Request $request);
    public function destroy(Request $request);
}
