<?php

namespace App\Repository;

use Illuminate\Http\Request;

interface PersonalInfoRepositoryInterface
{
    public function show();
    public function updateSettings(Request $request);
}
