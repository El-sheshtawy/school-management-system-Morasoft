<?php

namespace App\Http\Controllers\Classrooms;

use App\Http\Controllers\Controller;
use App\Models\Classroom;
use App\Models\Grade;
use Exception;
use Illuminate\Http\Request;
use App\Http\Requests\StoreClassroom;

class ClassroomController extends Controller
{
    public function index()
    {
        $classrooms = Classroom::all();
        $Grades = Grade::all();
        return view('Pages.My_Classes.My_Classes', compact('classrooms', 'Grades'));
    }

    public function store(StoreClassroom $request)
    {
        try {
            $classrooms = $request->List_Classes;

            foreach ($classrooms as $classroom) {

                Classroom::create([
                    'Name_Class'=> ['en'=>$classroom['Name_class_en'],'ar'=>$classroom['Name']],
                    'Grade_id'=>$classroom['Grade_id'],
                ]);
            }
            toastr()->success(trans('messages.success'));
            return redirect()->route('Classrooms.index');
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function update(Request $request)
    {
            try {

                $classroom=Classroom::findorFail($request->id);
                $classroom->update([
                    $classroom->Name_Class=['ar'=>$request->Name,'en'=>$request->Name_class_en],
                    $classroom->Grade_id = $request->Grade_id,
                ]);
                toastr()->success('messages.success');
                return redirect()->route('Classrooms.index');
            }
            catch (Exception $e){
                return back()->withErrors(['error'=>$e->getMessage()]);
            }
         }

    public function destroy(Request $request)
    {
        Classroom::findOrFail($request->id)->delete();
        toastr()->error(trans('messages.Delete'));
        return redirect()->route('Classrooms.index');
    }


    public function deleteAll(Request $request)
    {
        $delete_all_id = explode(",", $request->delete_all_id);

        Classroom::whereIn('id', $delete_all_id)->Delete();
        toastr()->error(trans('messages.Delete'));
        return redirect()->route('Classrooms.index');
    }


    public function filterClasses(Request $request)
    {
        $Grades = Grade::all();
        $classrooms=Classroom::all()->where('Grade_id',$request->Grade_id);
        return view('pages.My_Classes.My_Classes',compact('Grades','classrooms'));
    }
}
