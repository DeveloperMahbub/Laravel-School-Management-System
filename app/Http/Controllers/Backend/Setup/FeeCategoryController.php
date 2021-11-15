<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use App\Models\FeeCategory;
use Illuminate\Http\Request;

class FeeCategoryController extends Controller
{
    public function view()
    {
        $data['allData'] = FeeCategory::all();
        return view('backend.setup.fee_category.view-fee-category',$data);
    }

    public function add()
    {
        return view('backend.setup.fee_category.add-fee-category');
    }
    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => 'required|unique:fee_categories,name'

        ]);
        $data = new FeeCategory();
        $data->name = $request->name;
        $data->save();
        return redirect()->route('setups.fee.category.view')->with('success','Data Inserted Successfully!');

    }

    public function edit($id)
    {
        $editData = FeeCategory::findOrFail($id);
        return view('backend.setup.fee_category.add-fee-category',compact('editData'));
    }
    public function update(Request $request, $id)
    {
        $data = FeeCategory::findOrFail($id);
        $this->validate($request,[
            'name' => 'required|unique:fee_categories,name,'.$data->id

        ]);
        $data->name = $request->name;
        $data->save();
        return redirect()->route('setups.fee.category.view')->with('success','Data Updated Successfully!');

    }
    // public function delete($id)
    // {
    //     $data = Year::findOrFail($id);
    //     $data->delete();
    //     return redirect()->route('setups.student.class.view')->with('success','Data Deleted Successfully!');
    // }
}
