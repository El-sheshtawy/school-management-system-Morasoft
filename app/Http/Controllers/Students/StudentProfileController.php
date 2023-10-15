<?php

namespace App\Http\Controllers\Students;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;
use function Symfony\Component\String\s;

class StudentProfileController extends Controller
{
    public function index():View
    {
        $student=Student::where('id',auth()->guard('student')->user()->id)->first();
        return view('pages.Students.Profile.profile',compact('student'));
    }

    public function update(Request $request):RedirectResponse
    {
        $student=Student::where('id', auth()->guard('student')->user()->id)->first();
        if (!empty($request->password))
        $student->update([
            'name'=>['ar'=>$request->Name_ar,'en'=>$request->Name_en],
            'password'=>Hash::make($request->password),
        ]); else{
            $student->update([
                'name'=>['ar'=>$request->Name_ar,'en'=>$request->Name_en],
            ]);
        }
        toastr()->success('message.Update');
        return redirect()->back();
    }
}
