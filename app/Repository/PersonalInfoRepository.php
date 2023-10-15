<?php

namespace App\Repository;

use App\Models\PersonalInfo;
use App\Models\Photo;
use Illuminate\Http\Request;

class PersonalInfoRepository implements PersonalInfoRepositoryInterface
{
    public function show()
    {
        $personalInfoCollection = PersonalInfo::all();
        $personalInfo['personalInfo'] = $personalInfoCollection->flatMap(function ($personalInfoCollection) {
            return [$personalInfoCollection->key => $personalInfoCollection->value];
        });
        return view('pages.personal.personal', $personalInfo);
    }

    public function updateSettings(Request $request)
    {
        $personalInfo = $request->except("_token", "_method");
        foreach ($personalInfo as $key => $value) {
            PersonalInfo::where('key', $key)->update([
                'value' => $value,
            ]);
        }
        if($request->hasFile('photo'))
        {
            $photo=$request->file('photo');
                $photoName = $photo->getClientOriginalName();
                $photo->storeAs('/personal_info', $photoName, 'personal_info');
                Photo::create([
                    'photoname' => $photoName,
                ]);
                PersonalInfo::where('key', 'photo')->update([
                    'value' => $photoName,
                ]);
        }
        return redirect()->to('/dashboard');
    }
}
