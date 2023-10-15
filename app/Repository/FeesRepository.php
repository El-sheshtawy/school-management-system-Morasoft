<?php

namespace App\Repository;

use App\Models\Fee;
use App\Models\Grade;
use App\Http\Requests\FeeRequest;
use App\Models\Student;
use Illuminate\Http\Request;


class FeesRepository implements FeesRepositoryInterface
{
    public function index()
    {
        $fees=Fee::all();
        return view('pages.Fees.index',compact('fees'));
    }

    public function create()
    {
        $Grades=Grade::all();
        return view('pages.Fees.add',compact('Grades'));
    }

    public function edit($id)
    {
        $Grades=Grade::all();
        $fee=Fee::findOrFail($id);
        return view('pages.Fees.edit',compact('fee','Grades'));
    }

    public function store(FeeRequest $request)
    {
        try {
            $fee = new Fee();
            $fee->title = ['ar' => $request->title_ar, 'en' => $request->title_en];
            $fee->amount=$request->amount;
            $fee->Grade_id = $request->Grade_id;
            $fee->Classroom_id = $request->Classroom_id;
            $fee->description = $request->description;
            $fee->year = $request->year;
            $fee->Fee_type=$request->Fee_type;
            $fee->save();
            toastr()->success('messages.success');
            return redirect()->route('Fees.index');
        }
        catch (\Exception $e){
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    public function update(FeeRequest $request)
    {
        try {
            Fee::findOrFail($request->id)->update([
                'title'=>['ar' => $request->title_ar, 'en' => $request->title_en],
                'amount'=>$request->amount,
                'Grade_id'=>$request->Grade_id,
                'Classroom_id'=> $request->Classroom_id,
                'description'=>$request->description,
                'year'=>$request->year,
                'Fee_type'=>$request->Fee_type,
            ]);
            toastr()->success('messages.success');
            return redirect()->route('Fees.index');
        } catch (\Exception $e){
            return redirect()->back()->withErrors($e->getMessage());
        }
    }
    public function destroy(Request $request)
    {
        try {
            Fee::findOrFail($request->id)->delete();
            toastr()->error(__('messages.Delete'));
            return redirect()->route('Fees.index');
        }
        catch (\Exception $e){
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    public function show($id)
    {
        $fee=Fee::findOrFail($id);
        $students=Student::where('Grade_id',$fee->Grade_id)->where('Classroom_id',$fee->Classroom_id)->get();
       return $students;
    }
}
