@extends('backend.layouts.master')
  
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Manage Assign Subject</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Assign Subject</li>
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
                  Add Assign Subject
                    <a class="btn btn-success float-right btn-sm" href="{{ route('setups.assign.subject.view') }}"><i class="fa fa-list"></i> Assign Subject List</a>
                </h3>
            </div><!-- /.card-header -->
            <div class="card-body">
                <form method="post" action="{{route('setups.assign.subject.store') }}" id="myForm" enctype="multipart/form-data">
                    @csrf
                    <div class="add_item">
                        <div class="form-row">
                            <div class="form-group col-md-3">
                                <label>Class Name</label>
                                <select name="class_id" class="form-control" required>
                                    <option value="">Select Class</option>
                                    @foreach ($classes as $cls)
                                        <option value="{{ $cls->id }}">{{ $cls->name }}</option>
                                    @endforeach
                                </select>
                                <font style="color: red">{{ ($errors->has('fee_category_id'))?($errors->first('fee_category_id')):'' }}</font>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-3">
                                <label>Subject</label>
                                <select name="subject_id[]" class="form-control" required>
                                    <option value="">Select Class</option>
                                    @foreach ($subjects as $subject)
                                        <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                                    @endforeach
                                </select>
                                {{-- <font style="color: red">{{ ($errors->has('class_id[]'))?($errors->first('class_id[]')):'' }}</font> --}}
                            </div>
                            <div class="form-group col-md-2">
                                <label>Full Mark</label>
                                <input type="text" name="full_mark[]" class="form-control" placeholder="Enter Full Mark" required>
                                {{-- <font style="color: red">{{ ($errors->has('amount[]'))?($errors->first('amount[]')):'' }}</font> --}}
                            </div>
                            <div class="form-group col-md-2">
                                <label>Pass Mark</label>
                                <input type="text" name="pass_mark[]" class="form-control" placeholder="Enter Pass Mark" required>
                            </div>
                            <div class="form-group col-md-2">
                                <label>Subjective Mark</label>
                                <input type="text" name="subjective_mark[]" class="form-control" placeholder="Enter Get Mark" required>
                            </div>
                            
                            <div class="form-group col-md-1" style="padding-top: 30px">
                                <span class="btn btn-success addeventmore" title="Add More"><i class="fa fa-plus-circle"></i></span>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
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


{{-- for extra field html--}}

<div style="visibility: hidden;">
    <div class="whole_extra_item_add" id="whole_extra_item_add">
        <div class="delete_whole_extra_item_add" id="delete_whole_extra_item_add">
            <div class="form-row">
                <div class="form-group col-md-3">
                    <label>Subject</label>
                    <select name="subject_id[]" class="form-control" required>
                        <option value="">Select Class</option>
                        @foreach ($subjects as $subject)
                            <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                        @endforeach
                    </select>
                    {{-- <font style="color: red">{{ ($errors->has('class_id[]'))?($errors->first('class_id[]')):'' }}</font> --}}
                </div>
                <div class="form-group col-md-2">
                    <label>Full Mark</label>
                    <input type="text" name="full_mark[]" class="form-control" placeholder="Enter Full Mark" required>
                    {{-- <font style="color: red">{{ ($errors->has('amount[]'))?($errors->first('amount[]')):'' }}</font> --}}
                </div>
                <div class="form-group col-md-2">
                    <label>Pass Mark</label>
                    <input type="text" name="pass_mark[]" class="form-control" placeholder="Enter Pass Mark" required>
                </div>
                <div class="form-group col-md-2">
                    <label>Subjective Mark</label>
                    <input type="text" name="subjective_mark[]" class="form-control" placeholder="Enter Get Mark" required>
                </div>
                
                <div class="form-group col-md-1" style="padding-top: 30px">
                    <div class="form-row">
                        <span class="btn btn-success addeventmore" title="Add More"><i class="fa fa-plus-circle"></i></span>
                        <span class="btn btn-danger removeeventmore" title="Remove"><i class="fa fa-minus-circle"></i></span>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- for extra field js--}}

<script type="text/javascript">
  $(document).ready(function(){
    var counter = 0;
    $(document).on('click','.addeventmore',function(){
        var whole_extra_item_add = $('#whole_extra_item_add').html();
        $(this).closest('.add_item').append(whole_extra_item_add);
        counter++;
    });
    $(document).on('click','.removeeventmore',function(event){
        $(this).closest('.delete_whole_extra_item_add').remove();
        counter -= 1;
    });
  });
</script>

<script type="text/javascript">
  $(document).ready(function () {
    $('#myForm').validate({
      rules: {
        "class_id": {
          required: true,
        },
        "subject_id[]": {
          required: true,
        },
        "full_mark[]": {
          required: true,
        },
        "pass_mark[]": {
          required: true,
        },
        "subjective_mark[]": {
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