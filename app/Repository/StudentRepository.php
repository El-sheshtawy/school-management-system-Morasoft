<?php

namespace App\Repository;

use App\Http\Requests\StoreStudent;
use App\Models\Classroom;
use App\Models\Gender;
use App\Models\Grade;
use App\Models\Image;
use App\Models\My_Parent;
use App\Models\Nationalitie;
use App\Models\Section;
use App\Models\Student;
use App\Models\Type_Blood;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class StudentRepository implements StudentRepositoryInterface
{
    public function getClassrooms($id)
    {
        $list_classes = Classroom::where("Grade_id", $id)->pluck("Name_Class", "id");
        return $list_classes;

    }

    public function getSections($id)
    {
        $list_sections = Section::where("Class_id", $id)->pluck("Name_Section", "id");
        return $list_sections;
    }


    public function getStudents()
    {
        $students=Student::all();
        return view('pages.Students.index',compact('students'));
    }

    public function createStudent()
    {
        $data['my_classes'] = Grade::all();
        $data['parents'] = My_Parent::all();
        $data['Genders'] = Gender::all();
        $data['nationals'] = Nationalitie::all();
        $data['bloods'] = Type_Blood::all();
        return view('pages.Students.add',$data);
    }

    public function storeStudent(StoreStudent $request)
    {
        try {
            DB::beginTransaction();
            $request->validated();
            $Student = new Student();
            $Student->name = ['ar' => $request->name_ar, 'en' => $request->name_en];
            $Student->email = $request->email;
            $Student->password = Hash::make($request->password);
            $Student->Date_Birth = $request->Date_Birth;
            $Student->academic_year = $request->academic_year;
            $Student->gender_id = $request->gender_id;
            $Student->nationalitie_id=$request->nationalitie_id;
            $Student->blood_id = $request->blood_id;
            $Student->Grade_id = $request->Grade_id;
            $Student->Classroom_id = $request->Classroom_id;
            $Student->section_id = $request->section_id;
            $Student->parent_id = $request->parent_id;
            $Student->save();

            if ($request->hasFile('photos'))
            {
                foreach ($request->file('photos') as $file)
                {
                    $name=$file->getClientOriginalName();
                    $file->storeAs('attachments/students/'.$Student->name,$name,'upload_attachments');

                    $images=new Image();
                    $images->filename=$name;
                    $images->imageable_id=$Student->id;
                    $images->imageable_type='App\Models\Student';
                    $images->save();
                }
            }
            DB::commit();
            toastr()->success('messages.success');
            return redirect()->route('Students.index');
            }
            catch (\Exception $e)
            {
                DB::rollBack();
                return back()->withErrors(['error'=>$e->getMessage()]);
            }
    }


    public function editStudent($id)
    {
        $data['Grades'] = Grade::all();
        $data['parents'] = My_Parent::all();
        $data['Genders'] = Gender::all();
        $data['nationals'] = Nationalitie::all();
        $data['bloods'] = Type_Blood::all();
        $Students=Student::findOrFail($id);
        return view('pages.Students.edit',$data,compact('Students'));
    }

    public function updateStudent(Request $request)
    {
        try {
            $validatedUpdatedInputs=[
                'name_ar' => 'required',
                'name_en' => 'required',
                'email' => 'required|email|unique:students,email,'.$request->id,
                'password' => 'required|string|min:6|max:10',
                'gender_id' => 'required',
                'nationalitie_id' => 'required',
                'blood_id' => 'required',
                'Date_Birth' => 'required|date|date_format:Y-m-d',
                'Grade_id' => 'required',
                'Classroom_id' => 'required',
                'section_id' => 'required',
                'parent_id' => 'required',
                'academic_year' => 'required',
            ];
            $request->validate($validatedUpdatedInputs);

            $Edit_Students = Student::findOrFail($request->id);

            $updatedInuputs = [
                'name' => ['ar' => $request->name_ar, 'en' => $request->name_en],
                'email'=> $request->email,
                'password' => Hash::make($request->password),
                'gender_id'=> $request->gender_id,
                'nationalitie_id' => $request->nationalitie_id,
                'blood_id' => $request->blood_id,
                'Date_Birth' => $request->Date_Birth,
                'Grade_id' => $request->Grade_id,
                'Classroom_id' => $request->Classroom_id,
                'section_id' => $request->section_id,
                'parent_id'=> $request->parent_id,
                'academic_year' => $request->academic_year,
            ];

            $Edit_Students->update($updatedInuputs);
            toastr()->success(trans('messages.Update'));
            return redirect()->route('Students.index');
        }
        catch (\Exception $e){
            return back()->withErrors(['error'=>$e->getMessage()]);
        }
    }

    public function deleteStudent(Request $request)
    {
        Student::findOrFail($request->id)->delete();
        toastr()->error(trans('messages.Delete'));
        return redirect()->route('Students.index');
    }

    public function showStudent($id)
    {
        $Student=Student::findOrFail($id);
        return view('pages.Students.show',compact('Student'));
    }

    public function uploadStudentAttachments(Request $request)
    {
        if ($request->hasFile('photos')) {

            foreach ($request->file('photos') as $file) {
                $fileName = $file->getClientOriginalName();
                $file->storeAs('attachments/students/'.$request->student_name, $fileName,'upload_attachments');

                Image::create([
                    'filename' => $fileName,
                    'imageable_id' => $request->student_id,
                    'imageable_type' => 'App\Models\Student',
                ]);
            }
            toastr()->success(trans('messages.success'));
            return redirect()->route('Students.show', $request->student_id);
        }
    }

    public function downloadStudentAttachments($studentName, $fileName)
    {
        return response()->download(public_path('attachments/students/'.$studentName.'/'.$fileName));

    }
    public function deleteStudentAttachment(Request $request)
    {

        Storage::disk('upload_attachments')->delete('attachments/students/'.$request->student_name.'/'.$request->filename);

        image::where('id',$request->id)->where('filename',$request->filename)->delete();
        toastr()->error(__('messages.Delete'));
        return redirect()->route('Students.show',$request->student_id);
    }
}
