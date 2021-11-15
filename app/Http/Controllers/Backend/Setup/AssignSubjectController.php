<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use App\Models\AssignSubject;
use App\Models\StudentClass;
use App\Models\Subject;
use Illuminate\Http\Request;

class AssignSubjectController extends Controller
{
    public function view()
    {
        $data['allData'] = AssignSubject::select('class_id')->groupBy('class_id')->get();
        return view('backend.setup.assign_subject.view-assign-subject',$data);
    }

    public function add()
    {
        $data['subjects'] = Subject::all();
        $data['classes'] = StudentClass::all();
        return view('backend.setup.assign_subject.add-assign-subject',$data);
    }
    public function store(Request $request)
    {
        // $this->validate($request,[
        //     'fee_category_id' => 'required',
        //     'class_id[]' => 'required',
        //     'amount[]' => 'required',

        // ]);
        $subjectCount = count($request->subject_id);
        if ($subjectCount != NULL) {
            for ($i=0; $i <$subjectCount ; $i++) { 
                $assign_sub = new AssignSubject();
                $assign_sub->class_id = $request->class_id;
                $assign_sub->subject_id = $request->subject_id[$i];
                $assign_sub->full_mark = $request->full_mark[$i];
                $assign_sub->pass_mark = $request->pass_mark[$i];
                $assign_sub->subjective_mark = $request->subjective_mark[$i];
                $assign_sub->save();

            }
        }
        return redirect()->route('setups.assign.subject.view')->with('success','Data Inserted Successfully!');

    }

    public function edit($class_id)
    {
        $data['editData'] = AssignSubject::where('class_id',$class_id)->orderBy('class_id','asc')->get();
        // dd($data['editData']->toArray());
        $data['subjects'] = Subject::all();
        $data['classes'] = StudentClass::all();
        return view('backend.setup.assign_subject.edit-assign-subject',$data);
    }
    public function update(Request $request, $class_id)
    {
        if ($request->subject_id == Null) {
            return redirect()->back()->with('error','Sorry! You do not select any Item');
        }
        else{
            // at first delete previous record
            AssignSubject::where('class_id',$class_id)->delete();
            // Reasign Record
            $subjectCount = count($request->subject_id);
                for ($i=0; $i <$subjectCount ; $i++) { 
                    $assign_sub = new AssignSubject();
                    $assign_sub->class_id = $request->class_id;
                    $assign_sub->subject_id = $request->subject_id[$i];
                    $assign_sub->full_mark = $request->full_mark[$i];
                    $assign_sub->pass_mark = $request->pass_mark[$i];
                    $assign_sub->subjective_mark = $request->subjective_mark[$i];
                    $assign_sub->save();
    
                }
        }
        return redirect()->route('setups.assign.subject.view')->with('success','Data Inserted Successfully!');
    }

    public function details($class_id)
    {
        $data['editData'] = AssignSubject::where('class_id',$class_id)->orderBy('class_id','asc')->get();
        return view('backend.setup.assign_subject.details-assign-subject',$data);
    }
    // public function delete($id)
    // {
    //     $data = Year::findOrFail($id);
    //     $data->delete();
    //     return redirect()->route('setups.student.class.view')->with('success','Data Deleted Successfully!');
    // }
}
