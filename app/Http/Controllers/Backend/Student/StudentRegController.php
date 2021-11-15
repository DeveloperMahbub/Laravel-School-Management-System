<?php

namespace App\Http\Controllers\Backend\Student;

use App\Http\Controllers\Controller;
use App\Models\AssignStudent;
use App\Models\DiscountStudent;
use App\Models\StudentClass;
use App\Models\StudentGroup;
use App\Models\StudentShift;
use App\Models\User;
use App\Models\Year;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;


class StudentRegController extends Controller
{
    public function view()
    {
        $data['years'] = Year::orderBy('id','desc')->get();
        $data['classes'] = StudentClass::all();
        $data['year_id'] = Year::orderBy('id','desc')->first()->id;
        $data['class_id'] = StudentClass::orderBy('id','asc')->first()->id;
        $data['allData'] = AssignStudent::where('year_id',$data['year_id'])->where('class_id',$data['class_id'])->get();
        return view('backend.student.student_reg.view-student',$data);
    }

    public function year_class_search(Request $request)
    {
        $data['years'] = Year::orderBy('id','desc')->get();
        $data['classes'] = StudentClass::all();
        $data['year_id'] = $request->year_id;
        $data['class_id'] = $request->class_id;
        $data['allData'] = AssignStudent::where('year_id',$data['year_id'])->where('class_id',$data['class_id'])->get();
        return view('backend.student.student_reg.view-student',$data);
        
    }

    public function add()
    {
        $data['years'] = Year::orderBy('id','desc')->get();
        $data['classes'] = StudentClass::all();
        $data['groups'] = StudentGroup::all();
        $data['shifts'] = StudentShift::all();
        return view('backend.student.student_reg.add-student',$data);
    }
    public function store(Request $request)
    {
        $this->validate($request,[
            // 'name' => 'required|unique:subjects,name'
            'name' => 'required',
            'fname' => 'required',
            'mname' => 'required',
            'mobile' => 'required',
            'address' => 'required',
            'gender' => 'required',
            'religion' => 'required',
            'dob' => 'required',
            'discount' => 'required',
            'year_id' => 'required',
            'class_id' => 'required',
            'image' => 'required'

        ]);

        DB::transaction(function () use($request){
            $chekYear = Year::find($request->year_id)->name;
            $student = User::where('usertype','student')->orderBy('id','desc')->first();
            if ($student == null) {
                $firstReg = 0;
                $studentId = $firstReg+1;
                if($studentId <10)
                {
                    $id_no = '000'.$studentId;
                }elseif($studentId <100){
                    $id_no = '00'.$studentId;

                }elseif($studentId <1000){
                    $id_no = '0'.$studentId;

                }

            }else{
                $student = User::where('usertype','student')->orderBy('id','desc')->first()->id;
                $studentId = $student+1;
                if($studentId <10)
                {
                    $id_no = '000'.$studentId;
                }elseif($studentId <100){
                    $id_no = '00'.$studentId;

                }elseif($studentId <1000){
                    $id_no = '0'.$studentId;

                }
            }
            $final_id_no = $chekYear.$id_no;
            $user = new User();
            $code = rand(0000,9999);
            $user->id_no = $final_id_no;
            $user->password = bcrypt($code);
            $user->usertype = 'student';

            $user->code = $code;
            $user->name = $request->name;
            $user->fname = $request->fname;
            $user->mname = $request->mname;
            $user->mobile = $request->mobile;
            $user->address = $request->address;
            $user->gender = $request->gender;
            $user->religion = $request->religion;
            $user->dob = date('Y-m-d',strtotime($request->dob));
            if($request->file('image'))
            {
                $file = $request->file('image');
                $filename = date('YmdHi').$file->getClientOriginalName();
                $file->move(public_path('upload/student_images/'),$filename);
                $user['image'] = $filename;
            }
            $user->save();

            $assign_student = new AssignStudent();
            $assign_student->student_id = $user->id;
            $assign_student->year_id = $request->year_id;
            $assign_student->class_id = $request->class_id;
            $assign_student->group_id = $request->group_id;
            $assign_student->shift_id = $request->shift_id;
            $assign_student->save();

            $discount_student = new DiscountStudent();
            $discount_student->assign_student_id = $assign_student->id;
            $discount_student->fee_category_id = '1';
            $discount_student->discount = $request->discount;
            $discount_student->save();
        });
        return redirect()->route('students.registration.view')->with('success','Data Inserted Successfully!');

    }

    public function edit($student_id)
    {
        $data['editData'] = AssignStudent::with('student','discount')->where('student_id',$student_id)->first();
        // dd($data['editData']->toArray());
        $data['years'] = Year::orderBy('id','desc')->get();
        $data['classes'] = StudentClass::all();
        $data['groups'] = StudentGroup::all();
        $data['shifts'] = StudentShift::all();
        return view('backend.student.student_reg.add-student',$data);
    }
    public function update(Request $request, $student_id)
    {
        $this->validate($request,[
            // 'name' => 'required|unique:subjects,name'
            'name' => 'required',
            'fname' => 'required',
            'mname' => 'required',
            'mobile' => 'required',
            'address' => 'required',
            'gender' => 'required',
            'religion' => 'required',
            'dob' => 'required',
            'discount' => 'required',
            'year_id' => 'required',
            'class_id' => 'required'

        ]);
        DB::transaction(function () use($request, $student_id){
            $user = User::where('id',$student_id)->first();
            $user->name = $request->name;
            $user->fname = $request->fname;
            $user->mname = $request->mname;
            $user->mobile = $request->mobile;
            $user->address = $request->address;
            $user->gender = $request->gender;
            $user->religion = $request->religion;
            $user->dob = date('Y-m-d',strtotime($request->dob));
            if($request->file('image'))
            {
                $file = $request->file('image');
                @unlink(public_path('upload/student_images/'.$user->image));
                $filename = date('YmdHi').$file->getClientOriginalName();
                $file->move(public_path('upload/student_images/'),$filename);
                $user['image'] = $filename;
            }
            $user->save();

            $assign_student = AssignStudent::where('id',$request->id)->where('student_id',$student_id)->first();
            $assign_student->year_id = $request->year_id;
            $assign_student->class_id = $request->class_id;
            $assign_student->group_id = $request->group_id;
            $assign_student->shift_id = $request->shift_id;
            $assign_student->save();

            $discount_student = DiscountStudent::where('assign_student_id',$request->id)->first();
            $discount_student->discount = $request->discount;
            $discount_student->save();
        });
        return redirect()->route('students.registration.view')->with('success','Data Updated Successfully!');

    }

    public function promotion($student_id)
    {
        $data['editData'] = AssignStudent::with('student','discount')->where('student_id',$student_id)->first();
        // dd($data['editData']->toArray());
        $data['years'] = Year::orderBy('id','desc')->get();
        $data['classes'] = StudentClass::all();
        $data['groups'] = StudentGroup::all();
        $data['shifts'] = StudentShift::all();
        return view('backend.student.student_reg.promotion-student',$data);
    }

    public function promotionStore(Request $request, $student_id)
    {
        $this->validate($request,[
            // 'name' => 'required|unique:subjects,name'
            'name' => 'required',
            'fname' => 'required',
            'mname' => 'required',
            'mobile' => 'required',
            'address' => 'required',
            'gender' => 'required',
            'religion' => 'required',
            'dob' => 'required',
            'discount' => 'required',
            'year_id' => 'required',
            'class_id' => 'required'

        ]);
        DB::transaction(function () use($request, $student_id){
            $user = User::where('id',$student_id)->first();
            $user->name = $request->name;
            $user->fname = $request->fname;
            $user->mname = $request->mname;
            $user->mobile = $request->mobile;
            $user->address = $request->address;
            $user->gender = $request->gender;
            $user->religion = $request->religion;
            $user->dob = date('Y-m-d',strtotime($request->dob));
            if($request->file('image'))
            {
                $file = $request->file('image');
                @unlink(public_path('upload/student_images/'.$user->image));
                $filename = date('YmdHi').$file->getClientOriginalName();
                $file->move(public_path('upload/student_images/'),$filename);
                $user['image'] = $filename;
            }
            $user->save();

            $assign_student = new AssignStudent();
            $assign_student->student_id = $student_id;
            $assign_student->year_id = $request->year_id;
            $assign_student->class_id = $request->class_id;
            $assign_student->group_id = $request->group_id;
            $assign_student->shift_id = $request->shift_id;
            $assign_student->save();

            $discount_student = new DiscountStudent();
            $discount_student->assign_student_id = $assign_student->id;
            $discount_student->fee_category_id = '1';
            $discount_student->discount = $request->discount;
            $discount_student->save();
        });
        return redirect()->route('students.registration.view')->with('success','Student Promotion Successfully!');

    }
    public function details($student_id)
    {
        $data['details'] =  AssignStudent::where('student_id',$student_id)->first();
        // return view('backend.student.student_reg.student-details-pdf',$data);
        $pdf = PDF::loadView('backend.student.student_reg.student-details-pdf', $data);
        return $pdf->stream('student_info.pdf');
    }

    // public function delete($id)
    // {
    //     $data = Year::findOrFail($id);
    //     $data->delete();
    //     return redirect()->route('setups.student.class.view')->with('success','Data Deleted Successfully!');
    // }
}
