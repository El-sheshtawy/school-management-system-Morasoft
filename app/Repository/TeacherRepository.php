<?php

namespace App\Repository;
use Illuminate\Http\Request;
use App\Models\Gender;
use App\Models\Specialization;
use App\Models\Teacher;
use Exception;
use Illuminate\Support\Facades\Hash;


class TeacherRepository implements TeacherRepositoryInterface
{
    public function getAllTeachers()
    {
        return Teacher::all();
    }

    public function getAllSpecializations()
    {
      return Specialization::all();
    }

    public function getAllGenders()
    {
       return Gender::all();
    }
    public function storeTeacher(Request $request)
    {
        try {
            $request->validate([
                'Name_en'=>'required|max:20',
                'Name_ar'=>'required|max:20',
                'Email' => 'required|unique:teachers,Email,'.$request->id,
                'Password'=>'required|min:8|max:12',
                'Address'=>'required|min:12',
                'Joining_Date'=>'required|date',
                'Specialization_id'=>'required|integer',
                'Gender_id'=>'required|integer',
            ]);

            Teacher::create([
            'name'=>['ar'=>$request->Name_ar,'en'=>$request->Name_en],
            'email'=>$request->Email,
            'password'=>Hash::make($request->Password),
            'Address'=>$request->Address,
            'Joining_Date'=>$request->Joining_Date,
            'Specialization_id'=>$request->Specialization_id,
            'Gender_id'=>$request->Gender_id,
            'created_at'=>date('Y/m/d H:i:s'),
            'updated_at'=>date('Y/m/d H:i:s'),
            ]);
            toastr()->success('messages.success');
            return redirect()->route('Teachers.index');
        }
        catch (Exception $e)
        {
            return redirect()->back()->with(['error'=>$e->getMessage()]);
        }
    }

    public function editTeacher($id)
    {
      return Teacher::findOrFail($id);
    }

    public function updateTeacher(Request $request)
    {
        try {
            $request->validate([
                'Name_en'=>'required|max:20',
                'Name_ar'=>'required|max:20',
                'Email' => 'required|unique:teachers,Email,'.$request->id,
                'Password'=>'required|min:8|max:12',
                'Address'=>'required|min:12',
                'Joining_Date'=>'required|date',
                'Specialization_id'=>'required|integer',
                'Gender_id'=>'required|integer',
            ]);

            $Teacher=Teacher::findOrFail($request->id);
            $Teacher->update([
                $Teacher->name=['ar'=>$request->Name_ar,'en'=>$request->Name_en],
                $Teacher->email=$request->Email,
                $Teacher->password=Hash::make($request->Password),
                $Teacher->Address=$request->Address,
                $Teacher->Joining_Date=$request->Joining_Date,
                $Teacher->Specialization_id=$request->Specialization_id,
                $Teacher->Gender_id=$request->Gender_id,
                $Teacher->created_at=date('Y-m-d'),
                $Teacher->updated_at=date('Y-m-d'),
            ]);
            toastr()->success('messages.success');
            return redirect()->route('Teachers.index');
        } catch (Exception $e){
            return redirect()->back()->with(['error'=>$e->getMessage()]);
        }
    }

    public function deleteTeacher(Request $request)
    {
        Teacher::destroy($request->id);
        toastr()->error(trans('messages.Delete'));
        return redirect()->route('Teachers.index');
    }
}
