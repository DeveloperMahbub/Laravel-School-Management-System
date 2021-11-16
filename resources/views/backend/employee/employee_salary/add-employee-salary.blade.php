@extends('backend.layouts.master')
  
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Manage Employee Salary</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Employee Salary</li>
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
                <h3>Employee Salary Increment
                    <a class="btn btn-success float-right btn-sm" href="{{ route('employees.salary.view') }}"><i class="fa fa-list"></i> Employee Salary List</a>
                </h3>
            </div><!-- /.card-header -->
            <div class="card-body">
                <form method="post" action="{{ route('employees.salary.update',$editData->id) }}" id="myForm">
                    @csrf
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label>Salary Amount</label>
                            <input type="number" class="form-control" name="increment_salary" placeholder="Enter Increment Salary Amount" required>
                            <font style="color: red">{{ ($errors->has('increment_salary'))?($errors->first('increment_salary')):'' }}</font>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Effected Date</label>
                            <input type="text" class="form-control singledatepicker" autocomplete="off" name="effected_date" placeholder="YYYY-MM-DD" required>
                            <font style="color: red">{{ ($errors->has('effected_date'))?($errors->first('effected_date')):'' }}</font>
                        </div>
                        <div class="form-group col-md-4" style="padding-top: 30px">
                            <button type="submit" class="btn btn-primary">Submit</button>
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
            increment_salary: {
            required: true,
          },
          effected_date: {
            required: true,
          }
        },
        messages: {
          name: {
            required: "This Field is required!",
          },
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