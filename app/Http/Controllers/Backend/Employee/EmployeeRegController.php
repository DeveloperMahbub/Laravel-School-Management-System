<?php

namespace App\Http\Controllers\Backend\Employee;

use App\Http\Controllers\Controller;
use App\Models\Designation;
use App\Models\EmployeeSalaryLog;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;

class EmployeeRegController extends Controller
{
    public function view()
    {
        $data['allData'] = User::where('usertype','employee')->get();
        return view('backend.employee.employee_reg.view-employee',$data);
    }

    public function add()
    {
        $data['designations'] = Designation::all();
        return view('backend.employee.employee_reg.add-employee',$data);
    }
    public function store(Request $request)
    {
        $this->validate($request,[
            // 'name' => 'required|unique:users,name'
            'name' => 'required',
            'email' => 'required',
            'fname' => 'required',
            'mname' => 'required',
            'mobile' => 'required',
            'address' => 'required',
            'gender' => 'required',
            'religion' => 'required',
            'dob' => 'required',
            'salary' => 'required',
            'designation_id' => 'required',
            'join_date' => 'required',
            'image' => 'required'

        ]);

        DB::transaction(function () use($request){
            $chekYear = date('Ym',strtotime($request->join_date));
            $employee = User::where('usertype','employee')->orderBy('id','desc')->first();
            if ($employee == null) {
                $firstReg = 0;
                $employeeId = $firstReg+1;
                if($employeeId <10)
                {
                    $id_no = '000'.$employeeId;
                }elseif($employeeId <100){
                    $id_no = '00'.$employeeId;

                }elseif($employeeId <1000){
                    $id_no = '0'.$employeeId;

                }

            }else{
                $employee = User::where('usertype','employee')->orderBy('id','desc')->first()->id;
                $employeeId = $employee+1;
                if($employeeId <10)
                {
                    $id_no = '000'.$employeeId;
                }elseif($employeeId <100){
                    $id_no = '00'.$employeeId;

                }elseif($employeeId <1000){
                    $id_no = '0'.$employeeId;

                }
            }
            $final_id_no = $chekYear.$id_no;
            $user = new User();
            $code = rand(0000,9999);
            $user->id_no = $final_id_no;
            $user->password = bcrypt($code);
            $user->usertype = 'employee';

            $user->code = $code;
            $user->name = $request->name;
            $user->email = $request->email;
            $user->fname = $request->fname;
            $user->mname = $request->mname;
            $user->mobile = $request->mobile;
            $user->address = $request->address;
            $user->gender = $request->gender;
            $user->religion = $request->religion;
            $user->salary = $request->salary;
            $user->designation_id = $request->designation_id;
            $user->dob = date('Y-m-d',strtotime($request->dob));
            $user->join_date = date('Y-m-d',strtotime($request->join_date));
            if($request->file('image'))
            {
                $file = $request->file('image');
                $filename = date('YmdHi').$file->getClientOriginalName();
                $file->move(public_path('upload/employee_images/'),$filename);
                $user['image'] = $filename;
            }
            $user->save();

            $employee_salary = new EmployeeSalaryLog();
            $employee_salary->employee_id = $user->id;
            $employee_salary->effected_date = date('Y-m-d',strtotime($request->join_date));
            $employee_salary->previous_salary = $request->salary;
            $employee_salary->present_salary = $request->salary;
            $employee_salary->increment_salary = '0';
            $employee_salary->save();
        });
        return redirect()->route('employees.reg.view')->with('success','Data Inserted Successfully!');

    }

    public function edit($id)
    {
        $data['editData'] = User::findOrFail($id);
        // dd($data['editData']->toArray());
        $data['designations'] = Designation::all();
        return view('backend.employee.employee_reg.add-employee',$data);
    }
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            // 'name' => 'required|unique:users,name'
            'name' => 'required',
            'email' => 'required',
            'fname' => 'required',
            'mname' => 'required',
            'mobile' => 'required',
            'address' => 'required',
            'gender' => 'required',
            'religion' => 'required',
            'dob' => 'required',
            'designation_id' => 'required'
        ]);

        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->fname = $request->fname;
        $user->mname = $request->mname;
        $user->mobile = $request->mobile;
        $user->address = $request->address;
        $user->gender = $request->gender;
        $user->religion = $request->religion;
        $user->designation_id = $request->designation_id;
        $user->dob = date('Y-m-d',strtotime($request->dob));
        if($request->file('image'))
        {
            $file = $request->file('image');
            @unlink(public_path('upload/employee_images/'.$user->image));
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/employee_images/'),$filename);
            $user['image'] = $filename;
        }
        $user->save();
        return redirect()->route('employees.reg.view')->with('success','Data Updated Successfully!');

    }

    public function details($id)
    {
        $data['details'] =  User::findOrFail($id);
        // return view('backend.employee.employee_reg.employee-details-pdf',$data);
        $pdf = PDF::loadView('backend.employee.employee_reg.employee-details-pdf', $data);
        return $pdf->stream('employee_info.pdf');
    }

    // public function delete($id)
    // {
    //     $data = Year::findOrFail($id);
    //     $data->delete();
    //     return redirect()->route('setups.student.class.view')->with('success','Data Deleted Successfully!');
    // }
}
