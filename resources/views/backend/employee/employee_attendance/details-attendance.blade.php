@extends('backend.layouts.master')
@section('title','Employee Attendance List')
  
@section('content')
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
                <h3>Employee Attendance Details
                    <a class="btn btn-success float-right btn-sm" href="{{ route('employees.attendance.view') }}"><i class="fa fa-list"></i> Employee Attendance List</a>
                </h3>
            </div><!-- /.card-header -->
            <div class="card-body">
                <table id="example1" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                          <th>SL.</th>
                          <th>Name</th>
                          <th>ID NO</th>
                          <th>Email</th>
                          <th>Mobile</th>
                          <th>Date</th>
                          <th>Attend Status</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach ($details as $key => $detail)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ $detail->user->name}}</td>
                                <td>{{ $detail->user->id_no}}</td>
                                <td>{{ $detail->user->email}}</td>
                                <td>{{ $detail->user->mobile}}</td>
                                <td>{{ date('d-m-Y',strtotime($detail->date)) }}</td>
                                <td>{{ $detail->attend_status}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                </table>

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
@endsection