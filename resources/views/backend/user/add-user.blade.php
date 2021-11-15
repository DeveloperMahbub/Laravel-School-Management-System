@extends('backend.layouts.master')
  
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Manage User</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">User</li>
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
                <h3>Add User
                    <a class="btn btn-success float-right btn-sm" href="{{ route('users.view') }}"><i class="fa fa-list"></i> View User</a>
                </h3>
            </div><!-- /.card-header -->
            <div class="card-body">
                <form method="post" action="{{ route('users.store') }}" id="myForm">
                    @csrf
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="usertype">User Role</label>
                            <select name="role" id="role" class="form-control">
                                <option value="">Select Role</option>
                                <option value="Admin">Admin</option>
                                <option value="Operator">Operator</option>

                            </select>
                            <font style="color: red">{{ ($errors->has('usertype'))?($errors->first('usertype')):'' }}</font>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" name="name" placeholder="Enter Name" required>
                            <font style="color: red">{{ ($errors->has('name'))?($errors->first('name')):'' }}</font>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" name="email" placeholder="Enter Email" required>
                            <font style="color: red">{{ ($errors->has('email'))?($errors->first('email')):'' }}</font>
                            
                        </div>
                        <div class="form-group col-md-6">
                            <button type="submit" value="submit" class="btn btn-primary">Submit</button>
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
          role: {
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
            equalTo: "#cpassword"
          }
        },
        messages: {
          role: {
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
            equalTo: "Confirm Password does not match"
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