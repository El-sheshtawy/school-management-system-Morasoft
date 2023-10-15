<?php

namespace App\Http\Controllers\Sections;

use App\Http\Controllers\Controller;
use App\Models\Classroom;
use App\Models\Grade;
use App\Models\Section;
use App\Models\Teacher;
use Exception;
use Illuminate\Http\Request;
use App\Http\Requests\StoreSections;

class SectionController extends Controller
{
    public function index()
    {
        $Grades = Grade::with('Sections')->get();
        $list_Grades = Grade::all();
        $teachers = Teacher::all();
        return view('pages.Sections.Sections',compact('Grades','list_Grades','teachers'));
    }

    public function store(StoreSections $request)
    {
        try {
          $section = Section::create([
                'Name_Section'=>['ar'=>$request->Name_Section_Ar, 'en'=>$request->Name_Section_En],
                'Status'=>rand(0,1),
                'Grade_id'=>$request->Grade_id,
                'Class_id'=>$request->Class_id,
            ]);

            $section->teachers()->attach($request->teacher_id);
            toastr()->success(trans('messages.success'));
            return redirect()->route('Sections.index');
        }
        catch (Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function update(StoreSections $request)
    {
        try {
            $section = Section::findOrFail($request->id);
            $section->update([
                $section->Name_Section = ['ar' => $request->Name_Section_Ar, 'en' => $request->Name_Section_En],
                $section->Grade_id = $request->Grade_id,
                $section->Class_id = $request->Class_id,
            ]);

            if(isset($request->Status)) {
                $section->Status = 1;
            } else {
                $section->Status = 0;
            }

         if (isset($request->teacher_id)) {
                $section->teachers()->sync($request->teacher_id);
            } else {
                $section->teachers()->sync([]);
            }

            toastr()->success(trans('messages.Update'));
            return redirect()->route('Sections.index');
        }
        catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function destroy(Request $request)
    {
        Section::destroy($request->id);
        toastr()->error(trans('messages.Delete'));
        return redirect()->route('Sections.index');
    }

    public function getClasses($id)
    {
      //  $list_Classes = Classroom::where("Grade_id", $id)->pluck("Name_Class", "id");
        $classesList=Classroom::where('Grade_id',$id)->pluck('Name_Class','id');
        return $classesList;
    }
    //sync attach pluck
}

