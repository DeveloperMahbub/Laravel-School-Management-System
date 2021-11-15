@extends('backend.layouts.master')
  
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Manage Students</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Student</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <!-- Main row -->
      <div class="row">
        <!-- Left col -->
        <section class="col-md-12">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="card">
            <div class="card-header">
                <h3>
                        Promotion Student
                    
                    <a class="btn btn-success float-right btn-sm" href="{{ route('students.registration.view') }}"><i class="fa fa-list"></i> Students List</a>
                </h3>
            </div><!-- /.card-header -->
            <div class="card-body">
                <form method="post" action="{{route('students.registration.promotion.store',$editData->student_id)}}" id="myForm" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" value="{{ @$editData->id }}">
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label>Student Name <font style="color: red">*</font></label>
                            <input type="text" class="form-control form-control-sm" name="name" value="{{ @$editData->student->name }}" placeholder="Enter Year Name" required>
                            <font style="color: red">{{ ($errors->has('name'))?($errors->first('name')):'' }}</font>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Father's Name <font style="color: red">*</font></label>
                            <input type="text" class="form-control form-control-sm" name="fname" value="{{ @$editData->student->fname }}" placeholder="Enter Year Name" required>
                            <font style="color: red">{{ ($errors->has('fname'))?($errors->first('fname')):'' }}</font>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Mother's Name <font style="color: red">*</font></label>
                            <input type="text" class="form-control form-control-sm" name="mname" value="{{ @$editData->student->mname }}" placeholder="Enter Year Name" required>
                            <font style="color: red">{{ ($errors->has('mname'))?($errors->first('mname')):'' }}</font>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Mobile No <font style="color: red">*</font></label>
                            <input type="text" class="form-control form-control-sm" name="mobile" value="{{ @$editData->student->mobile }}" placeholder="Enter Year Name" required>
                            <font style="color: red">{{ ($errors->has('mobile'))?($errors->first('mobile')):'' }}</font>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Address <font style="color: red">*</font></label>
                            <input type="text" class="form-control form-control-sm" name="address" value="{{ @$editData->student->address }}" placeholder="Enter Year Name" required>
                            <font style="color: red">{{ ($errors->has('address'))?($errors->first('address')):'' }}</font>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Gender <font style="color: red">*</font></label>
                            <select name="gender" class="form-control form-control-sm">
                                <option value="">Select Gender</option>
                                <option value="Male" {{ (@$editData->student->gender == 'Male') ? 'selected':'' }}>Male</option>
                                <option value="Female" {{ (@$editData->student->gender == 'Female') ? 'selected':'' }}>Female</option>
                            </select>
                            <font style="color: red">{{ ($errors->has('gender'))?($errors->first('gender')):'' }}</font>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Religion <font style="color: red">*</font></label>
                            <select name="religion" class="form-control form-control-sm">
                                <option value="">Select Religion</option>
                                <option value="Islam" {{ (@$editData->student->religion == 'Islam') ? 'selected':'' }}>Islam</option>
                                <option value="Hindu" {{ (@$editData->student->religion == 'Hindu') ? 'selected':'' }}>Hindu</option>
                                <option value="Khristan" {{ (@$editData->student->religion == 'Khristan') ? 'selected':'' }}>Khristan</option>
                            </select>
                            <font style="color: red">{{ ($errors->has('religion'))?($errors->first('religion')):'' }}</font>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Date of Birth <font style="color: red">*</font></label>
                            <input type="text" class="form-control form-control-sm  {{ (@$editData->student->dob)?'':'singledatepicker' }}" name="dob" value="{{ @$editData->student->dob }}" autocomplete="off" placeholder="YYYY-MM-DD">
                            <font style="color: red">{{ ($errors->has('dob'))?($errors->first('dob')):'' }}</font>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Discount <font style="color: red">*</font></label>
                            <input type="text" class="form-control form-control-sm" name="discount" value="{{ @$editData->discount->discount }}" autocomplete="off" placeholder="Enter Year Name" required>
                            <font style="color: red">{{ ($errors->has('discount'))?($errors->first('discount')):'' }}</font>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Year <font style="color: red">*</font></label>
                            <select name="year_id" class="form-control form-control-sm">
                                <option value="">Select Year</option>
                                @foreach ($years as $year)
                                <option value="{{ $year->id }}" {{ (@$editData->year_id == $year->id) ? 'selected':'' }}>{{ $year->name }}</option>
                                @endforeach
                            </select>
                            <font style="color: red">{{ ($errors->has('year_id'))?($errors->first('year_id')):'' }}</font>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Class <font style="color: red">*</font></label>
                            <select name="class_id" class="form-control form-control-sm">
                                <option value="">Select Class</option>
                                @foreach ($classes as $cls)
                                <option value="{{ $cls->id }}" {{ (@$editData->class_id == $cls->id) ? 'selected':'' }}>{{ $cls->name }}</option>
                                @endforeach
                            </select>
                            <font style="color: red">{{ ($errors->has('class_id'))?($errors->first('class_id')):'' }}</font>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Group</label>
                            <select name="group_id" class="form-control form-control-sm">
                                <option value="">Select Group</option>
                                @foreach ($groups as $group)
                                <option value="{{ $group->id }}" {{ (@$editData->group_id == $group->id) ? 'selected':'' }}>{{ $group->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Shift</label>
                            <select name="shift_id" class="form-control form-control-sm">
                                <option value="">Select Shift</option>
                                @foreach ($shifts as $shift)
                                <option value="{{ $shift->id }}" {{ (@$editData->shift_id == $shift->id) ? 'selected':'' }}>{{ $shift->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Image <font style="color: red">*</font></label>
                            <input type="file" name="image" id="image" class="form-control form-control-sm" id="image">
                            <font style="color: red">{{ ($errors->has('image'))?($errors->first('image')):'' }}</font>
                        </div>
                        <div class="form-group col-md-4">
                            <img id="showImage" src="{{ (!empty($editData->student->image))? asset('upload/student_images/'.$editData->student->image): asset('upload/no_image.jpg') }}" style="width: 100px; height:110px; border: 1px solid #000;">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success btn-sm">{{ (@$editData)?'Promotion':'Submit' }}</button>
                   
                  </form>

            </div><!-- /.card-body -->
          </div>
          <!-- /.card -->
        </section>
        <!-- /.Left col -->
        
      </div>
      <!-- /.row (main row) -->
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<script type="text/javascript">
    $(document).ready(function () {
      $('#myForm').validate({
        rules: {
          "name": {
            required: true,
          },
          "fname": {
            required: true,
          },
          
          "mname": {
            required: true,
          },
          
          "mobile": {
            required: true,
          },
          "address": {
            required: true,
          },
          "gender": {
            required: true,
          },
          "religion": {
            required: true,
          },
          "dob": {
            required: true,
          },
          "discount": {
            required: true,
          },
          "year_id": {
            required: true,
          },
          "class_id": {
            required: true,
          }
        },
        messages: {
        },
        errorElement: 'span',
        errorPlacement: function (error, element) {
          error.addClass('invalid-feedback');
          element.closest('.form-group').append(error);
        },
        highlight: function (element, errorClass, validClass) {
          $(element).addClass('is-invalid');
        },
        unhighlight: function (element, errorClass, validClass) {
          $(element).removeClass('is-invalid');
        }
      });
    });
    </script>

    <script>
      $('.datepicker').datepicker({
        format: 'mm/dd/yyyy',
        startDate: '-3d'
      });
    </script>

@endsection