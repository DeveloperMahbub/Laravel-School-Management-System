<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use App\Models\Subject;
use Illuminate\Http\Request;
class SubjectController extends Controller
{
    public function view()
    {
        $data['allData'] = Subject::all();
        return view('backend.setup.subject.view-subject',$data);
    }

    public function add()
    {
        return view('backend.setup.subject.add-subject');
    }
    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => 'required|unique:subjects,name'

        ]);
        $data = new Subject();
        $data->name = $request->name;
        $data->save();
        return redirect()->route('setups.subject.view')->with('success','Data Inserted Successfully!');

    }

    public function edit($id)
    {
        $editData = Subject::findOrFail($id);
        return view('backend.setup.subject.add-subject',compact('editData'));
    }
    public function update(Request $request, $id)
    {
        $data = Subject::findOrFail($id);
        $this->validate($request,[
            'name' => 'required|unique:subjects,name,'.$data->id

        ]);
        $data->name = $request->name;
        $data->save();
        return redirect()->route('setups.subject.view')->with('success','Data Updated Successfully!');

    }
    // public function delete($id)
    // {
    //     $data = Year::findOrFail($id);
    //     $data->delete();
    //     return redirect()->route('setups.student.class.view')->with('success','Data Deleted Successfully!');
    // }
}
