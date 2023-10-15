<?php

namespace App\Http\Controllers\Grades;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreGrades;
use Exception;
use Illuminate\Http\Request;
use App\Models\Grade;

class GradeController extends Controller
{
    public function index()
    {
        $Grades=Grade::all();
        return view('Pages.Grades.Grades',compact('Grades'));
    }

    public function store(StoreGrades $request)
    {
        try {
            if (Grade::where('Name->ar', $request->Name)->orWhere("Name->en", $request->Name_en)->exists()) {
                toastr()->error(__('messages.repeated'));
                return redirect()->route('Grades.index');
            } else {
                Grade::create([
                    'Name' => ['ar' => $request->Name, 'en' => $request->Name_en],
                    'Notes' => $request->Notes,
                ]);
                toastr()->success(__('messages.success'));
                return redirect()->route('Grades.index');
                }
            }
        catch (Exception $e) {
                return  redirect()->back()->withErrors(['error'=>$e->getMessage()]);
            }
    }
    public function update(StoreGrades $request)
    {
            try {

                if (Grade::where('Name->ar',$request->Name)->orWhere("Name->en",$request->Name_en)->exists())
                {
                    toastr()->error(__('messages.repeated'));
                    return redirect()->route('Grades.index');
                } else {
                    Grade::findOrFail($request->id)->update([
                        'Name'=> ['ar' => $request->Name, 'en' => $request->Name_en],
                        'Notes' => $request->Notes,
                    ]);
                    toastr()->success(__('messages.update'));
                    return redirect()->route('Grades.index');
                }
            }
            catch (Exception $e) {
                return redirect()->back()->withErrors(['error' => $e->getMessage()]);
            }
        }

    public function destroy(Request $request)
    {
       Grade::findOrFail($request->id)->delete();
       //Grade::where('id',req->id)->delete();
        toastr()->error(__('messages.delete'));
        return redirect()->route('Grades.index');
    }
}
