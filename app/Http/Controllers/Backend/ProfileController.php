<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function view()
    {
        $id = Auth::user()->id;
        $user = User::findOrFail($id);
        return view('backend.user.view-profile',compact('user'));
    }
    public function edit()
    {
        $id = Auth::user()->id;
        $editData = User::findOrFail($id);
        return view('backend.user.edit-profile',compact('editData'));
    }
    public function update(Request $request)
    {
        $data = User::findOrFail(Auth::user()->id);
        $data->name = $request->name;
        // $data->email = $request->email;
        $data->mobile = $request->mobile;
        $data->address = $request->address;
        $data->gender = $request->gender;
        if($request->file('image'))
        {
            $file = $request->file('image');
            @unlink(public_path('upload/user_images/'.$data->image));
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/user_images/'),$filename);
            $data['image'] = $filename;
        }
        $data->save();
        return redirect()->route('profiles.view')->with('success','Profile Updated Successfully!');

    }
    public function passwordView()
    {
        return view('backend.user.edit-password');
    }

    public function passwordUpdate(Request $request)
    {
        if (Auth::guard('web')->attempt(['id'=>Auth::user()->id,'password'=>$request->current_password])) 
        {
            // dd('ok');
            $user = User::findOrFail(Auth::user()->id);
            $user->password = bcrypt($request->new_password);
            $user->save();
            return redirect()->route('profiles.view')->with('success','Password Updated Successfully!');
        }else{
            return redirect()->back()->with('error','Sorry! Your Current Password Does not Match');
        }
    }
}
