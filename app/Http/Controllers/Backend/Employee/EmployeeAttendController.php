<?php

namespace App\Http\Controllers\Backend\Employee;

use App\Http\Controllers\Controller;
use App\Models\EmployeeAttendance;
use App\Models\User;
use Illuminate\Http\Request;

class EmployeeAttendController extends Controller
{
    public function view()
    {
        $data['allData'] = EmployeeAttendance::select('date')->groupBy('date')->orderBy('id','desc')->get();
        return view('backend.employee.employee_attendance.view-attendance',$data);
    }

    public function add()
    {
        $data['employees'] = User::where('usertype','employee')->get();
        return view('backend.employee.employee_attendance.add-attendance',$data);
    }
    public function store(Request $request)
    {
        EmployeeAttendance::where('date',date('Y-m-d',strtotime($request->date)))->delete();
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

    public function edit($date)
    {
        $data['editData'] = EmployeeAttendance::where('date',$date)->get();
        $data['employees'] = User::where('usertype','employee')->get();
        return view('backend.employee.employee_attendance.add-attendance',$data);
    }

    public function details($date)
    {
        $data['details'] = EmployeeAttendance::where('date',$date)->get(); $data['employees'] = User::where('usertype','employee')->get();
        return view('backend.employee.employee_attendance.details-attendance',$data);
        // $pdf = PDF::loadView('backend.employee.employee_reg.employee-details-pdf', $data);
        // return $pdf->stream('employee_info.pdf');
    }
    // public function delete($date)
    // {
    //     $data = EmployeeAttendance::where('date',$date)->get();
    //     $data->delete();
    //     return redirect()->route('employees.attendance.view')->with('success','Data Deleted Successfully!');
    // }
}
