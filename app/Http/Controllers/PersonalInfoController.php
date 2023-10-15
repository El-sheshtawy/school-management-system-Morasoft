<?php

namespace App\Http\Controllers;

use App\Models\PersonalInfo;
use App\Repository\PersonalInfoRepositoryInterface;
use Illuminate\Http\Request;

class PersonalInfoController extends Controller
{
    protected PersonalInfoRepositoryInterface $personalInfo;

    public function __construct(PersonalInfoRepositoryInterface $personalInfo)
    {
        $this->personalInfo=$personalInfo;
    }

    public function show()
    {
        return $this->personalInfo->show();
    }


    public function update(Request $request)
    {
        return $this->personalInfo->updateSettings($request);
    }


    public function uploadImage(Request $request)
    {
        return $this->personalInfo->uploadImage($request);
    }
}
