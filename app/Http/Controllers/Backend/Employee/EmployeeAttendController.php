<?php

namespace App\Http\Controllers\Backend\Employee;

use App\Http\Controllers\Controller;
use App\Models\EmployeeAttendance;
use App\Models\EmployeeLeave;
use App\Models\LeavePurpose;
use App\Models\User;
use Illuminate\Http\Request;
use PDF;

class EmployeeAttendController extends Controller
{
    public function view()
    {
        $data['allData'] = EmployeeAttendance::orderBy('id','desc')->get();
        return view('backend.employee.employee_attendance.view-attendance',$data);
    }

    public function add()
    {
        $data['employees'] = User::where('usertype','employee')->get();
        return view('backend.employee.employee_attendance.add-attendance',$data);
    }
    public function store(Request $request)
    {
        $countemployee = count($request->employee_id);
        for ($i=0; $i < $countemployee; $i++) { 
            $attend_status = 'attend_status'.$i;
            $attend = new EmployeeAttendance();
            $attend->date = date('Y-m-d',strtotime($request->date));
            $attend->employee_id = $request->employee_id[$i];
            $attend->attend_status = $request->$attend_status;
            $attend->save();
        }
        return redirect()->route('employees.attendance.view')->with('success','Data Inserted Successfully!');

    }

    public function edit($id)
    {
        $data['editData'] = EmployeeLeave::findOrFail($id);
        $data['employees'] = User::where('usertype','employee')->get();
        $data['leave_purpose'] = LeavePurpose::all();
        return view('backend.employee.employee_leave.add-leave',$data);
    }
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            // 'name' => 'required|unique:users,name'
            'employee_id' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'leave_purpose_id' => 'required',
            'name'=>'unique:leave_purposes,name'

        ]);
        if($request->leave_purpose_id == "0")
        {
            $leavepurpose = new LeavePurpose();
            $leavepurpose->name = $request->name;
            $leavepurpose->save();
            $leave_purpose_id = $leavepurpose->id;
        }else{
            $leave_purpose_id = $request->leave_purpose_id;
        }
        $employee_leave = EmployeeLeave::findOrFail($id);
        $employee_leave->employee_id = $request->employee_id;
        $employee_leave->start_date = date('Y-m-d',strtotime($request->start_date));
        $employee_leave->end_date = date('Y-m-d',strtotime($request->end_date));
        $employee_leave->leave_purpose_id = $leave_purpose_id;
        $employee_leave->save();

        return redirect()->route('employees.leave.view')->with('success','Data Updated Successfully!');

    }

    // public function details($id)
    // {
    //     $data['details'] =  User::findOrFail($id);
    //     // return view('backend.employee.employee_reg.employee-details-pdf',$data);
    //     $pdf = PDF::loadView('backend.employee.employee_reg.employee-details-pdf', $data);
    //     return $pdf->stream('employee_info.pdf');
    // }
    // public function delete($id)
    // {
    //     $data = Year::findOrFail($id);
    //     $data->delete();
    //     return redirect()->route('setups.student.class.view')->with('success','Data Deleted Successfully!');
    // }
}
