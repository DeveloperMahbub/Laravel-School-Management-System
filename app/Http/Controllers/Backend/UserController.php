<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function view()
    {
        $data['allData'] = User::where('usertype','admin')->get();
        // dd($allData->toArray());
        // $allData = User::all();
        // return view('backend.user.view-user',compact('allData'));
        
        return view('backend.user.view-user',$data);
    }
    public function add()
    {
        // dd('ok');
        
        return view('backend.user.add-user');
    }
    public function store(Request $request)
    {
        $this->validate($request,[
            'role' => 'required',
            'name' => 'required',
            'email' => 'required|unique:users,email'

        ]);
        $data = new User();
        // Database-name-----------Fields-Name
        $code = rand(0000,9999);
        $data->usertype = 'admin';
        $data->role = $request->role;
        $data->name = $request->name;
        $data->email = $request->email;
        $data->password = bcrypt($code);
        $data->code = $code;
        $data->save();
        return redirect()->route('users.view')->with('success','Data Inserted Successfully!');
        
    }
    public function edit($id)
    {
        $editData = User::findOrFail($id);
        return view('backend.user.edit-user',compact('editData'));

    }

    public function update(Request $request, $id)
    {
        $data = User::findOrFail($id);
        $data->role = $request->role;
        $data->name = $request->name;
        $data->email = $request->email;
        $data->password = bcrypt($request->password);
        $data->save();
        return redirect()->route('users.view')->with('success','Data Updated Successfully!');

    }
    public function delete($id)
    {
        $user = User::findOrFail($id);
        if(file_exists('public/upload/user_images/' . $user->image) AND ! empty($user->image)){
            unlink('public/upload/user_images/' . $user->image);
        }
        $user->delete();
        return redirect()->route('users.view')->with('success','Data Deleted Successfully!');
    }
}
