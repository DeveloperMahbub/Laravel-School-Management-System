<?php

namespace App\Http\Controllers\Backend\Student;

use App\Http\Controllers\Controller;
use App\Models\AssignStudent;
use App\Models\ExamType;
use App\Models\FeeCategoryAmount;
use App\Models\StudentClass;
use App\Models\Year;
use Illuminate\Http\Request;
use PDF;


class ExamFeeController extends Controller
{
    public function view()
    {
        $data['years'] = Year::orderBy('id','desc')->get();
        $data['classes'] = StudentClass::all();
        $data['exam_types'] = ExamType::all();
        return view('backend.student.exam_fee.view-exam-fee',$data);
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
        $html['thsource'] .= '<th>Exam Fee</th>';
        $html['thsource'] .= '<th>Discount Amount</th>';
        $html['thsource'] .= '<th>Fee (This Student)</th>';
        $html['thsource'] .= '<th>Action</th>';
        foreach($allStudent as $key=> $v){
            $registrationfee = FeeCategoryAmount::where('fee_category_id', '3')->where('class_id', $v->class_id)->first();
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
            $html[$key]['tdsource'] .= '<a href="'.route("students.exam.fee.payslip").'?class_id='.$v->class_id. '&student_id='.$v->student_id.'&exam_type_id='.$request->exam_type_id.'" class="btn btn-sm btn-'.$color.'" title="Payslip" target="_blank">Fee Slip</a>';
            $html[$key]['tdsource'] .= '</td>';

        }
        return response()->json(@$html);
    }

    public function payslip(Request $request)
    {
        $student_id = $request->student_id;
        $class_id = $request->class_id;
        $data['exam_name'] = ExamType::where('id',$request->exam_type_id)->first()['name'];
        $data['details'] = AssignStudent::with(['discount','student'])->where('student_id',$student_id)->where('class_id',$class_id)->first();
        return view('backend.student.exam_fee.exam-fee-pdf',$data);
        // $pdf = PDF::loadView('backend.student.exam_fee.exam-fee-pdf',$data);
        // return $pdf->stream('student-payslip.pdf');

    }
}
