<?php

namespace App\Http\Controllers\Backend\Student;

use App\Http\Controllers\Controller;
use App\Models\AssignStudent;
use App\Models\DiscountStudent;
use App\Models\StudentClass;
use App\Models\StudentGroup;
use App\Models\StudentShift;
use App\Models\User;
use App\Models\Year;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;

class StudentRollController extends Controller
{
    public function view()
    {
        $data['years'] = Year::orderBy('id','desc')->get();
        $data['classes'] = StudentClass::all();
        return view('backend.student.roll_generate.view-roll-generate',$data);
    }

    public function getStudent(Request $request)
    {
        $allData = AssignStudent::with(['student'])->where('year_id', $request->year_id)->where('class_id', $request->class_id)->get();
        // dd($getStudent->toArray());
        return response()->json($allData);
    }
    public function store(Request $request)
    {
        $year_id = $request->year_id;
        $class_id = $request->class_id;
        if ($request->student_id !== null) {
            for ($i=0; $i < count($request->student_id) ; $i++) { 
                AssignStudent::where('year_id', $year_id)->where('class_id',$class_id)->where('student_id',$request->student_id[$i])->update(['roll'=>$request->roll[$i]]);
            }
            
        }else{
            return redirect()->back()->with('error','Sorry! There are no Student');
        }
        return redirect()->route('students.roll.view')->with('success','Successfully roll generated');

    }
}
