<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use App\Models\StudentShift;
use Illuminate\Http\Request;

class ShiftController extends Controller
{
    public function view()
    {
        $data['allData'] = StudentShift::all();
        return view('backend.setup.shift.view-shift',$data);
    }

    public function add()
    {
        return view('backend.setup.shift.add-shift');
    }
    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => 'required|unique:student_shifts,name'

        ]);
        $data = new StudentShift();
        $data->name = $request->name;
        $data->save();
        return redirect()->route('setups.student.shift.view')->with('success','Data Inserted Successfully!');

    }

    public function edit($id)
    {
        $editData = StudentShift::findOrFail($id);
        return view('backend.setup.shift.add-shift',compact('editData'));
    }
    public function update(Request $request, $id)
    {
        $data = StudentShift::findOrFail($id);
        $this->validate($request,[
            'name' => 'required|unique:student_shifts,name,'.$data->id

        ]);
        $data->name = $request->name;
        $data->save();
        return redirect()->route('setups.student.shift.view')->with('success','Data Updated Successfully!');

    }
    // public function delete($id)
    // {
    //     $data = Year::findOrFail($id);
    //     $data->delete();
    //     return redirect()->route('setups.student.class.view')->with('success','Data Deleted Successfully!');
    // }
}
