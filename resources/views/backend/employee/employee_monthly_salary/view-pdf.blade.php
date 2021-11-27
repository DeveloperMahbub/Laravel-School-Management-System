@php
    ini_set('max_execution_time', 180);
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Employee Monthly Salary</title>
    <link rel="stylesheet" href="{{ asset('backend/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <style>
        .container{
            width:100%;
            padding-right:15px;
            padding-left:15px;
            margin-right:auto;
            margin-left:auto
        }
        @media (min-width:576px){.container{max-width:540px}}
        @media (min-width:768px){.container{max-width:720px}}
        @media (min-width:992px){.container{max-width:960px}}
        @media (min-width:1200px){.container{max-width:1140px}}
        table{
            border-collapse: collapse;
        }
        h2,h3{
            margin: 0;
            padding: 0;
        }
        .table{
            width: 100px;
            margin-bottom: 1rem;
            background-color: transparent;
        }
        .table th, .table td{
            padding: 0.75rem;
            vertical-align: top;
            border-top: 1px solid #dee2e6;
        }
        .table thead th{
            vertical-align: bottom;
            border-bottom: 1px solid #dee2e6;
        }
        .table tbody + tbody{
            border-top: 1px solid #dee2e6;
        }
        .table .table{
            background-color: #fff;
        }
        .table-bordered{
            border: 1px solid #dee2e6;
        }

        .table-bordered th,
        .table-bordered td{
            border: 1px solid #dee2e6;
        }

        .text-center{
            text-align: center;
        }
        .text-right{
            text-align: right;
        }
        table tr td{
            padding: 5px;
        }
        .table-bordered thead th, .table-bordered td, .table-bordered th{
            border: 1px solid black !important;
        }
        .table-bordered thead th{
            background-color: #cacaca;
        }
    </style>
</head>
<body>
    <div class="container">
        @php
            $date = date('Y-m', strtotime($totalattendgroupbyid['0']->date));
            if($date != '')
            {
                $where[]= ['date','like',$date.'%'];
            }
            $totalattend = App\Models\EmployeeAttendance::with(['user'])->where($where)->where('employee_id',$totalattendgroupbyid['0']->employee_id)->get();
            $sigleSalary = (float)$totalattendgroupbyid['0']['user']['salary'];
            $salaryperday = (float)$sigleSalary/30;
            $absentcount = count($totalattend->where('attend_status','Absent'));
            $totalsalaryminus = (int)$absentcount*(float)$salaryperday;
            $totalsalary = (int)$sigleSalary-(int)$totalsalaryminus;
        @endphp
        <div class="row">
            <div class="col-md-12">
                <table width="80%">
                    <tr>
                        <td width="33%" class="text-center">
                            <img src="{{ asset('upload/abc_school.jpg') }}" alt="" style="width: 100px; height:100px">
                        </td>
                        <td class="text-center" width="63%">
                            <h4><strong>Abc School</strong></h4>
                            <h5><strong>Mirpur, Dhaka</strong></h5>
                            <h6><strong>www.abcschoolbd.com</strong></h6>
                        </td>
                        <td class="text-center">
                            <img src="{{(!empty($totalattendgroupbyid['0']->user->image))?asset('upload/employee_images/'.$totalattendgroupbyid['0']->user->image): asset('upload/no_image.jpg') }}" alt="" style="width: 100px; height:100px">
                        </td>
                    </tr>
                </table>
            </div>
            <div class="col-md-12 text-center">
                <h5 style="font-weight: bold; padding-top: -25px">Employee Monthly Salary</h5>
            </div>
            <div class="col-md-12">
                <table border="1" width="100%">
                    <tbody>
                        <tr>
                            <td style="width: 50%">Employee Name</td>
                            <td>{{ $totalattendgroupbyid['0']->user->name }}</td>
                        </tr>
                        <tr>
                            <td style="width: 50%">Id No</td>
                            <td>{{ $totalattendgroupbyid['0']->user->id_no }}</td>
                        </tr>
                        <tr>
                            <td style="width: 50%">Basic Salary</td>
                            <td>{{ $totalattendgroupbyid['0']->user->salary }}</td>
                        </tr>
                        <tr>
                            <td style="width: 50%">Total Absent This Month</td>
                            <td>{{ $absentcount }}</td>
                        </tr>
                        <tr>
                            <td style="width: 50%">Month</td>
                            <td>{{ date('M Y',strtotime($totalattendgroupbyid['0']->date)) }}</td>
                        </tr>
                        <tr>
                            <td style="width: 50%">Salary For This Month</td>
                            <td>{{ $totalsalary }}</td>
                        </tr>
                    </tbody>
                </table>
                <i style="font-size: 10px; float:left">Print Date: {{ date("d M Y") }}</i>
            </div><br><br>
            <div class="col-md-12">
                <table border="0" width="100%">
                    <tbody>
                        <tr>
                            <td style="width:30%"></td>
                            <td style="width:30%"></td>
                            <td style="width:40%; text-align:center">
                                <hr style="border: solid 1px; width:60%; color: #000; margin-bottom:0px">
                                <p style="text-align: center;">Principal/Headmaster</p>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <hr style="border: dashed 1px; width: 96%; color: #000; margin-bottom: 50px">

        <div class="row">
            <div class="col-md-12">
                <table width="80%">
                    <tr>
                        <td width="33%" class="text-center">
                            <img src="{{ asset('upload/abc_school.jpg') }}" alt="" style="width: 100px; height:100px">
                        </td>
                        <td class="text-center" width="63%">
                            <h4><strong>Abc School</strong></h4>
                            <h5><strong>Mirpur, Dhaka</strong></h5>
                            <h6><strong>www.abcschoolbd.com</strong></h6>
                        </td>
                        <td class="text-center">
                            <img src="{{(!empty($totalattendgroupbyid['0']->user->image))?asset('upload/employee_images/'.$totalattendgroupbyid['0']->user->image): asset('upload/no_image.jpg') }}" alt="" style="width: 100px; height:100px">
                        </td>
                    </tr>
                </table>
            </div>
            <div class="col-md-12 text-center">
                <h5 style="font-weight: bold; padding-top: -25px">Employee Monthly Salary</h5>
            </div>
            <div class="col-md-12">
                <table border="1" width="100%">
                    <tbody>
                        <tr>
                            <td style="width: 50%">Employee Name</td>
                            <td>{{ $totalattendgroupbyid['0']->user->name }}</td>
                        </tr>
                        <tr>
                            <td style="width: 50%">Id No</td>
                            <td>{{ $totalattendgroupbyid['0']->user->id_no }}</td>
                        </tr>
                        <tr>
                            <td style="width: 50%">Basic Salary</td>
                            <td>{{ $totalattendgroupbyid['0']->user->salary }}</td>
                        </tr>
                        <tr>
                            <td style="width: 50%">Total Absent This Month</td>
                            <td>{{ $absentcount }}</td>
                        </tr>
                        <tr>
                            <td style="width: 50%">Month</td>
                            <td>{{ date('M Y',strtotime($totalattendgroupbyid['0']->date)) }}</td>
                        </tr>
                        <tr>
                            <td style="width: 50%">Salary For This Month</td>
                            <td>{{ $totalsalary }}</td>
                        </tr>
                    </tbody>
                </table>
                <i style="font-size: 10px; float:left">Print Date: {{ date("d M Y") }}</i>
            </div><br><br>
            <div class="col-md-12">
                <table border="0" width="100%">
                    <tbody>
                        <tr>
                            <td style="width:30%"></td>
                            <td style="width:30%"></td>
                            <td style="width:40%; text-align:center">
                                <hr style="border: solid 1px; width:60%; color: #000; margin-bottom:0px">
                                <p style="text-align: center;">Principal/Headmaster</p>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
</body>
</html>