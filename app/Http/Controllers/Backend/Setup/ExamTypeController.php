<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use App\Models\ExamType;
use Illuminate\Http\Request;

class ExamTypeController extends Controller
{
    public function view()
    {
        $data['allData'] = ExamType::all();
        return view('backend.setup.exam_type.view-exam-type',$data);
    }

    public function add()
    {
        return view('backend.setup.exam_type.add-exam-type');
    }
    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => 'required|unique:exam_types,name'

        ]);
        $data = new ExamType();
        $data->name = $request->name;
        $data->save();
        return redirect()->route('setups.exam.type.view')->with('success','Data Inserted Successfully!');

    }

    public function edit($id)
    {
        $editData = ExamType::findOrFail($id);
        return view('backend.setup.exam_type.add-exam-type',compact('editData'));
    }
    public function update(Request $request, $id)
    {
        $data = ExamType::findOrFail($id);
        $this->validate($request,[
            'name' => 'required|unique:exam_types,name,'.$data->id

        ]);
        $data->name = $request->name;
        $data->save();
        return redirect()->route('setups.exam.type.view')->with('success','Data Updated Successfully!');

    }
    // public function delete($id)
    // {
    //     $data = Year::findOrFail($id);
    //     $data->delete();
    //     return redirect()->route('setups.student.class.view')->with('success','Data Deleted Successfully!');
    // }
}
