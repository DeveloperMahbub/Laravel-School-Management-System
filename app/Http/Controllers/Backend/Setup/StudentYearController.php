<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use App\Models\Year;
use Illuminate\Http\Request;
class StudentYearController extends Controller
{
    public function view()
    {
        $data['allData'] = Year::all();
        return view('backend.setup.year.view-year',$data);
    }

    public function add()
    {
        return view('backend.setup.year.add-year');
    }
    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => 'required|unique:years,name'

        ]);
        $data = new Year();
        $data->name = $request->name;
        $data->save();
        return redirect()->route('setups.student.year.view')->with('success','Data Inserted Successfully!');

    }

    public function edit($id)
    {
        $editData = Year::findOrFail($id);
        return view('backend.setup.year.add-year',compact('editData'));
    }
    public function update(Request $request, $id)
    {
        $data = Year::findOrFail($id);
        $this->validate($request,[
            'name' => 'required|unique:years,name,'.$data->id

        ]);
        $data->name = $request->name;
        $data->save();
        return redirect()->route('setups.student.year.view')->with('success','Data Updated Successfully!');

    }
    // public function delete($id)
    // {
    //     $data = Year::findOrFail($id);
    //     $data->delete();
    //     return redirect()->route('setups.student.class.view')->with('success','Data Deleted Successfully!');
    // }
}
