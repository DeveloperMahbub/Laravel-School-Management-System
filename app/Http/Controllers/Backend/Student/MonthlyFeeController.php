<?php

namespace App\Http\Controllers\Backend\Student;

use App\Http\Controllers\Controller;
use App\Models\AssignStudent;
use App\Models\FeeCategoryAmount;
use App\Models\StudentClass;
use App\Models\Year;
use Illuminate\Http\Request;
use PDF;

class MonthlyFeeController extends Controller
{
    public function view()
    {
        $data['years'] = Year::orderBy('id','desc')->get();
        $data['classes'] = StudentClass::all();
        return view('backend.student.monthly_fee.view-monthly-fee',$data);
    }

    public function getStudent(Request $request)
    {
        $year_id = $request->year_id;
        $class_id = $request->class_id;
        if ($year_id != '') {
            $where[] = ['year_id','like', $year_id.'%'];
        }
        if ($class_id != '') {
            $where[] = ['class_id','like', $class_id.'%'];
        }
        $allStudent = AssignStudent::with(['discount'])->where($where)->get();

        $html['thsource'] = '<th>SL</th>';
        $html['thsource'] .= '<th>ID No</th>';
        $html['thsource'] .= '<th>Student Name</th>';
        $html['thsource'] .= '<th>Roll No</th>';
        $html['thsource'] .= '<th>Monthly Fee</th>';
        $html['thsource'] .= '<th>Discount Amount</th>';
        $html['thsource'] .= '<th>Fee (This Student)</th>';
        $html['thsource'] .= '<th>Action</th>';
        foreach($allStudent as $key=> $v){
            $registrationfee = FeeCategoryAmount::where('fee_category_id', '2')->where('class_id', $v->class_id)->first();
            $color = 'success';
            $html[$key]['tdsource'] = '<td>'.($key+1).'</td>';
            $html[$key]['tdsource'] .= '<td>'.$v->student->id_no.'</td>';
            $html[$key]['tdsource'] .= '<td>'.$v->student->name.'</td>';
            $html[$key]['tdsource'] .= '<td>'.$v->roll.'</td>';
            $html[$key]['tdsource'] .= '<td>'.$registrationfee->amount.'TK'.'</td>';
            $html[$key]['tdsource'] .= '<td>'.$v->discount->discount.'%'.'</td>';

            $originalfee = $registrationfee->amount;
            $discount = $v->discount->discount;
            $discountablefee = $discount/100*$originalfee;
            $finalfee = (float)$originalfee-(float)$discountablefee;

            $html[$key]['tdsource'] .= '<td>'.$finalfee.'TK'.'</td>';
            $html[$key]['tdsource'] .= '<td>';
            $html[$key]['tdsource'] .= '<a href="'.route("students.monthly.fee.payslip").'?class_id='.$v->class_id. '&student_id='.$v->student_id.'&month='.$request->month.'" class="btn btn-sm btn-'.$color.'" title="Payslip" target="_blank">Fee Slip</a>';
            $html[$key]['tdsource'] .= '</td>';

        }
        return response()->json(@$html);
    }

    public function payslip(Request $request)
    {
        $student_id = $request->student_id;
        $class_id = $request->class_id;
        $data['month'] = $request->month;
        $data['details'] = AssignStudent::with(['discount','student'])->where('student_id',$student_id)->where('class_id',$class_id)->first();
        $pdf = PDF::loadView('backend.student.monthly_fee.monthly-fee-pdf',$data);
        return $pdf->stream('student-payslip.pdf');

    }
}
