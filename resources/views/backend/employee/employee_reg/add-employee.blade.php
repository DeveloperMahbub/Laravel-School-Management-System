@extends('backend.layouts.master')
  
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Manage Employee</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Employee</li>
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
                    @if (isset($editData))
                        Edit Employee
                    @else
                        Add Employee
                    @endif
                    <a class="btn btn-success float-right btn-sm" href="{{ route('employees.reg.view') }}"><i class="fa fa-list"></i> Employee List</a>
                </h3>
            </div><!-- /.card-header -->
            <div class="card-body">
                <form method="post" action="{{ (@$editData)? route('employees.reg.update',$editData->id) : route('employees.reg.store') }}" id="myForm" enctype="multipart/form-data">
                    @csrf
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label>Employee Name <font style="color: red">*</font></label>
                            <input type="text" class="form-control form-control-sm" name="name" value="{{ @$editData->name }}" placeholder="Enter Your Name" required>
                            <font style="color: red">{{ ($errors->has('name'))?($errors->first('name')):'' }}</font>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Father's Name <font style="color: red">*</font></label>
                            <input type="text" class="form-control form-control-sm" name="fname" value="{{ @$editData->fname }}" placeholder="Enter Father Name" required>
                            <font style="color: red">{{ ($errors->has('fname'))?($errors->first('fname')):'' }}</font>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Mother's Name <font style="color: red">*</font></label>
                            <input type="text" class="form-control form-control-sm" name="mname" value="{{ @$editData->mname }}" placeholder="Enter Mother Name" required>
                            <font style="color: red">{{ ($errors->has('mname'))?($errors->first('mname')):'' }}</font>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Email <font style="color: red">*</font></label>
                            <input type="email" class="form-control form-control-sm" name="email" value="{{ @$editData->email }}" placeholder="Enter Your Email" required>
                            <font style="color: red">{{ ($errors->has('name'))?($errors->first('email')):'' }}</font>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Mobile No <font style="color: red">*</font></label>
                            <input type="text" class="form-control form-control-sm" name="mobile" value="{{ @$editData->mobile }}" placeholder="Enter Mobile" required>
                            <font style="color: red">{{ ($errors->has('mobile'))?($errors->first('mobile')):'' }}</font>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Address <font style="color: red">*</font></label>
                            <input type="text" class="form-control form-control-sm" name="address" value="{{ @$editData->address }}" placeholder="Enter Address" required>
                            <font style="color: red">{{ ($errors->has('address'))?($errors->first('address')):'' }}</font>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Gender <font style="color: red">*</font></label>
                            <select name="gender" class="form-control form-control-sm">
                                <option value="">Select Gender</option>
                                <option value="Male" {{ (@$editData->gender == 'Male') ? 'selected':'' }}>Male</option>
                                <option value="Female" {{ (@$editData->gender == 'Female') ? 'selected':'' }}>Female</option>
                            </select>
                            <font style="color: red">{{ ($errors->has('gender'))?($errors->first('gender')):'' }}</font>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Religion <font style="color: red">*</font></label>
                            <select name="religion" class="form-control form-control-sm">
                                <option value="">Select Religion</option>
                                <option value="Islam" {{ (@$editData->religion == 'Islam') ? 'selected':'' }}>Islam</option>
                                <option value="Hindu" {{ (@$editData->religion == 'Hindu') ? 'selected':'' }}>Hindu</option>
                                <option value="Khristan" {{ (@$editData->religion == 'Khristan') ? 'selected':'' }}>Khristan</option>
                            </select>
                            <font style="color: red">{{ ($errors->has('religion'))?($errors->first('religion')):'' }}</font>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Date of Birth <font style="color: red">*</font></label>
                            <input type="text" class="form-control form-control-sm  {{ (@$editData->dob)?'':'singledatepicker' }}" name="dob" value="{{ @$editData->dob }}" autocomplete="off" placeholder="YYYY-MM-DD">
                            <font style="color: red">{{ ($errors->has('dob'))?($errors->first('dob')):'' }}</font>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Designation <font style="color: red">*</font></label>
                            <select name="designation_id" class="form-control form-control-sm">
                                <option value="">Select Designation</option>
                                @foreach ($designations as $designation)
                                <option value="{{ $designation->id }}" {{ (@$editData->designation_id == $designation->id) ? 'selected':'' }}>{{ $designation->name }}</option>
                                @endforeach
                            </select>
                            <font style="color: red">{{ ($errors->has('year_id'))?($errors->first('year_id')):'' }}</font>
                        </div>
                        @if (!@$editData)
                        <div class="form-group col-md-4">
                            <label>Join Date <font style="color: red">*</font></label>
                            <input type="text" class="form-control form-control-sm  {{ (@$editData->join_date)?'':'singledatepicker' }}" name="join_date" value="{{ @$editData->join_date }}" autocomplete="off" placeholder="YYYY-MM-DD">
                            <font style="color: red">{{ ($errors->has('dob'))?($errors->first('dob')):'' }}</font>
                        </div>
                        @endif
                        @if (!@$editData)
                        <div class="form-group col-md-4">
                            <label>Salary <font style="color: red">*</font></label>
                            <input type="text" class="form-control form-control-sm" name="salary" value="{{ @$editData->salary }}" autocomplete="off" placeholder="Enter Salary" required>
                            <font style="color: red">{{ ($errors->has('discount'))?($errors->first('discount')):'' }}</font>
                        </div>
                        @endif
                        
                        <div class="form-group col-md-4">
                            <label>Image <font style="color: red">*</font></label>
                            <input type="file" name="image" id="image" class="form-control form-control-sm" id="image">
                            <font style="color: red">{{ ($errors->has('image'))?($errors->first('image')):'' }}</font>
                        </div>
                        <div class="form-group col-md-4">
                            <img id="showImage" src="{{ (!empty($editData->image))? asset('upload/employee_images/'.$editData->image): asset('upload/no_image.jpg') }}" style="width: 100px; height:110px; border: 1px solid #000;">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary btn-sm">{{ (@$editData)?'Update':'Submit' }}</button>
                   
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
          "email": {
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
          "salary": {
            required: true,
          },
          "designation_id": {
            required: true,
          },
          "join_date": {
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