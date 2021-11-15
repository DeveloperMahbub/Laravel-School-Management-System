@extends('backend.layouts.master')
  
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Manage Profile</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Profile</li>
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
                <h3>Edit Profile
                    <a class="btn btn-success float-right btn-sm" href="{{ route('profiles.view') }}"><i class="fa fa-long-arrow-alt-left"></i> Back</a>
                </h3>
            </div><!-- /.card-header -->
            <div class="card-body">
                <form method="post" action="{{ route('profiles.update') }}" id="myForm" enctype="multipart/form-data">
                    @csrf
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" name="name" value="{{ $editData->name }}" placeholder="Enter Name" required>
                            <font style="color: red">{{ ($errors->has('name'))?($errors->first('name')):'' }}</font>
                        </div>
                        {{-- <div class="form-group col-md-4">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" name="email"  value="{{ $editData->email }}" placeholder="Enter Email" required>
                            <font style="color: red">{{ ($errors->has('email'))?($errors->first('email')):'' }}</font>
                            
                        </div> --}}
                        <div class="form-group col-md-4">
                            <label for="mobile">Mobile No</label>
                            <input type="text" class="form-control" name="mobile"  value="{{ $editData->mobile }}" placeholder="Enter Mobile No" required>
                            <font style="color: red">{{ ($errors->has('mobile'))?($errors->first('mobile')):'' }}</font>
                            
                        </div>
                        <div class="form-group col-md-4">
                            <label for="address">Address</label>
                            <input type="text" class="form-control" name="address"  value="{{ $editData->address }}" placeholder="Enter Address" required>
                            <font style="color: red">{{ ($errors->has('address'))?($errors->first('address')):'' }}</font>
                            
                        </div>
                        <div class="form-group col-md-4">
                            <label for="gender">Gender</label>
                            <select name="gender" id="gender" class="form-control">
                                <option value="">Select Gender</option>
                                <option value="Male" {{ ($editData->gender=="Male"? "selected":"") }}>Male</option>
                                <option value="Female" {{ ($editData->gender=="Female"? "selected":"") }}>Female</option>

                            </select>
                            <font style="color: red">{{ ($errors->has('usertype'))?($errors->first('usertype')):'' }}</font>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="image">Image</label>
                            <input type="file" name="image" class="form-control" id="image">
                        </div>
                        <div class="form-group col-md-2">
                            <img id="showImage" src="{{ (!empty($editData->image))? asset('upload/user_images/'.$editData->image): asset('upload/no_image.jpg') }}" alt="{{ $editData->name }}" style="width: 150px; height:160px; border: 1px solid #000;">
                        </div>
                        
                        <div class="form-group col-md-6" style="padding-top: 30px">
                            <button type="submit" value="update" class="btn btn-primary">Update</button>
                        </div>
                       

                    </div>
                   
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
            usertype: {
            required: true,
          },
          email: {
            required: true,
            email: true,
          },
          password: {
            required: true,
            minlength: 6
          },
          password2: {
            required: true,
            minlength: '#password'
          }
        },
        messages: {
            usertype: {
            required: "Please select a user role",
          },
          email: {
            required: "Please enter a email address",
            email: "Please enter a <em>valid</em> email address"
          },
          password: {
            required: "Please Enter password",
            minlength: "Your password must be at least 6 characters long"
          },
          password2: {
            required: "Please enter confirm password",
            minlength: "Confirm Password does not match"
          }
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

@endsection