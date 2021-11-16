<?php

namespace App\Http\Controllers\Backend\Employee;

use App\Http\Controllers\Controller;
use App\Models\EmployeeSalaryLog;
use App\Models\User;
use Illuminate\Http\Request;
use PDF;

class EmployeeSalaryController extends Controller
{
    public function view()
    {
        $data['allData'] = User::where('usertype','employee')->get();
        return view('backend.employee.employee_salary.view-employee-salary',$data);
    }

    public function increment($id)
    {
        $data['editData'] = User::findOrFail($id);
        // dd($data['editData']->toArray());
        return view('backend.employee.employee_salary.add-employee-salary',$data);
    }
    
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            // 'name' => 'required|unique:users,name'
            'increment_salary' => 'required',
            'effected_date' => 'required',
        ]);
        $user = User::findOrFail($id);
        $previous_salary = $user->salary;
        $present_salary = (float)$previous_salary+(float)$request->increment_salary;
        $user->salary = $present_salary;
        $user->save();

        $salaryData = new EmployeeSalaryLog();
        $salaryData->employee_id = $id;
        $salaryData->previous_salary = $previous_salary;
        $salaryData->increment_salary = $request->increment_salary;
        $salaryData->present_salary = $present_salary;
        $salaryData->effected_date = date('Y-m-d',strtotime($request->effected_date));
        $salaryData->save();

        return redirect()->route('employees.salary.view')->with('success','Salary Increment Successfully!');
    }

    public function details($id)
    {
        $data['details'] =  User::findOrFail($id);
        $data['salary_log'] = EmployeeSalaryLog::where('employee_id',$data['details']->id)->get();
        return view('backend.employee.employee_salary.employee-salary-details',$data);
        // $pdf = PDF::loadView('backend.employee.employee_reg.employee-details-pdf', $data);
        // return $pdf->stream('employee_info.pdf');
    }

    // public function delete($id)
    // {
    //     $data = Year::findOrFail($id);
    //     $data->delete();
    //     return redirect()->route('setups.student.class.view')->with('success','Data Deleted Successfully!');
    // }
}
