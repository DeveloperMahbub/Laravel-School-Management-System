@extends('backend.layouts.master')
@section('title','Employee Attendance List')
  
@section('content')
<style>
    .switch-toggle{
        width: auto;
    }
    .switch-toggle label:not(.disabled){
        cursor: pointer;
    }
    .switch-candy a{
        bottom: 1px solid #333;
        border-radius: 3px;
        box-shadow: 0 1px 1px rgba(0, 0, 0, 0.2), inset 0 1px 1px rgba(255, 255, 255, 0.45);
        background-color: #fff;
        background-image: -webkit-linear-gradient(top, rgba(255, 255, 255, 0.2), transparent);
        background-image: linear-gradient(to bottom,, rgba(255, 255, 255, 0.2), transparent);
    }
    .switch-toggle.switch-candy, .switch-light.switch-candy> span{
        background-color: #5a6268;
        border-radius: 3px;
        box-shadow: inset 0 2px 6px rgba(0, 0, 0, 0.3), 0 1px 0px rgba(255, 255, 255, 0.2);
    }
    .switch-toggle input[type="radio"] {
        opacity: 0;
        position: fixed;
        width: 0;
    }
    .switch-toggle label {
    display: inline-block;
    padding: 0 20px;
    color: #fff;
    font-family: sans-serif, Arial;
    font-size: 16px;
}
.switch-toggle input[type="radio"]:checked + label {
    border: 1px solid #444;
    border-radius: 3px;
    background-color:#fff;
    color: #000;
    
}
</style>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Manage Employee Attendance</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Employee Attendance</li>
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
                        Edit Employee Attendance
                    @else
                        Add Employee Attendance
                    @endif
                    <a class="btn btn-success float-right btn-sm" href="{{ route('employees.leave.view') }}"><i class="fa fa-list"></i> Employee Leave List</a>
                </h3>
            </div><!-- /.card-header -->
            <div class="card-body">
               <form method="post" action="{{ route('employees.attendance.store') }}" id="myForm">
                   @csrf
                   <div class="form-group col-md-4">
                       <label class="control-label">Attendance Date</label>
                       <input type="text" name="date" id="date" class="checkdate form-control form-control-sm singledatepicker" placeholder="Attendance date" autocomplete="off">

                   </div>
                   <table class="table-sm table-bordered table-striped dt-responsive" style="width: 100%">
                    <thead>
                        <tr>
                            <th rowspan="2" class="text-center" style="vertical-align: middle">SL</th>
                            <th rowspan="2" class="text-center" style="vertical-align: middle">Employee Name</th>
                            <th colspan="3" class="text-center" style="vertical-align: middle; width:25%">Attendance Status</th>
                        </tr>
                        <tr>
                            <th class="text-center btn present_all" style="display: table-cell; background-color: #114190">Present</th>
                            <th class="text-center btn leave_all" style="display: table-cell; background-color: #114190">Leave</th>
                            <th class="text-center btn absent_all" style="display: table-cell; background-color: #114190">Absent</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($employees as $key =>$employee)
                        <tr id="div{{ $employee->id }}" class="text-center">
                            <input type="hidden" name="employee_id[]" value="{{ $employee->id }}" class="employee_id">
                            <td>{{ $key+1 }}</td>
                            <td>{{ $employee->name }}</td>
                            <td colspan="3">
                                <div class="switch-toggle switch-3 switch-candy">
                                    <input class="present" type="radio" name="attend_status{{ $key }}" id="present{{ $key }}" value="Present" checked>
                                    <label for="present{{ $key }}">Present</label>
                                    <input class="leave" type="radio" name="attend_status{{ $key }}" id="leave{{ $key }}" value="Leave">
                                    <label for="leave{{ $key }}">Leave</label>
                                    <input class="absent" type="radio" name="attend_status{{ $key }}" id="absent{{ $key }}" value="Absent">
                                    <label for="absent{{ $key }}">Absent</label>
                                    <a></a>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                   </table><br>
                   <button type="submit" class="btn btn-success btn-sm">{{ (@$editData)?'Update':'Submit' }}</button>
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
<script>
    $(document).on('click', '.present',function(){
        $(this).parents('tr').find('.datetime').css('pointer-events','none').css('background-color','#dee2e6').css('color','#495057');
    });
    $(document).on('click', '.leave',function(){
        $(this).parents('tr').find('.datetime').css('pointer-events','').css('background-color','#fff').css('color','#495057');
    });
    $(document).on('click', '.absent',function(){
        $(this).parents('tr').find('.datetime').css('pointer-events','none').css('background-color','#dee2e6').css('color','#dee2e6');
    });
</script>
<script>
    $(document).on('click', '.present_all',function(){
        $('input[value=Present]').prop('checked',true);
        $('datetime').css('pointer-events','none').css('background-color','#dee2e6').css('color','#495057');
    });
    $(document).on('click', '.leave_all',function(){
        $('input[value=Leave]').prop('checked',true);
        $('datetime').css('pointer-events','none').css('background-color','#ffff').css('color','#495057');
    });
    $(document).on('click', '.absent_all',function(){
        $('input[value=Absent]').prop('checked',true);
        $('datetime').css('pointer-events','none').css('background-color','#dee2e6').css('color','#dee2e6');
    });
</script>

<script type="text/javascript">
    $(document).ready(function () {
      $('#myForm').validate({
        rules: {
            date: {
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

@endsection