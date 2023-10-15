<?php

namespace App\Repository;

use Illuminate\Http\Request;

interface StudentPromotionRepositoryInterface
{
    public function index();
    public function store(Request $request);
    public function create();
    public function destroy(Request $request);
}
