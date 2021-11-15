<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use App\Models\StudentGroup;
use Illuminate\Http\Request;
class StudentGroupController extends Controller
{
    public function view()
    {
        $data['allData'] = StudentGroup::all();
        return view('backend.setup.group.view-group',$data);
    }

    public function add()
    {
        return view('backend.setup.group.add-group');
    }
    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => 'required|unique:student_groups,name'

        ]);
        $data = new StudentGroup();
        $data->name = $request->name;
        $data->save();
        return redirect()->route('setups.student.group.view')->with('success','Data Inserted Successfully!');

    }

    public function edit($id)
    {
        $editData = StudentGroup::findOrFail($id);
        return view('backend.setup.group.add-group',compact('editData'));
    }
    public function update(Request $request, $id)
    {
        $data = StudentGroup::findOrFail($id);
        $this->validate($request,[
            'name' => 'required|unique:student_groups,name,'.$data->id

        ]);
        $data->name = $request->name;
        $data->save();
        return redirect()->route('setups.student.group.view')->with('success','Data Updated Successfully!');

    }
    // public function delete($id)
    // {
    //     $data = Year::findOrFail($id);
    //     $data->delete();
    //     return redirect()->route('setups.student.class.view')->with('success','Data Deleted Successfully!');
    // }
}
