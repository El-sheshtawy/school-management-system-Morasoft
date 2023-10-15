<?php

namespace App\Http\Controllers\Teachers;

use App\Http\Controllers\Controller;
use App\Models\Teacher;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class TeacherProfileController extends Controller
{
    public function index():View
    {
        $teacher=Teacher::findOrFail(Auth::guard('teacher')->user()->id);
        return view('pages.Teachers.dashboard.profile',compact('teacher'));
    }
    public function update(Request $request):RedirectResponse
    {
        $teacher=Teacher::findOrFail(Auth::guard('teacher')->user()->id);
        if (!empty($request->password)){
            $teacher->update([
            'name'=>['en'=>$request->Name_en,'ar'=>$request->Name_ar],
            'password'=>Hash::make($request->password),
                ]);
        } else {
            $teacher->update([
                'name'=>['en'=>$request->Name_en,'ar'=>$request->Name_ar],
            ]);
        }
        toastr()->success('message.Update');
        return redirect()->back();
    }
}
