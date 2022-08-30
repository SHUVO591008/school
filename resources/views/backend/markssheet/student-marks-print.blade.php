
@extends('layouts.app')


@section('web')

    <style>
        a.nav-link {
            font-size: 12px;
            font-weight: 600;
            padding: 0.75rem 1rem 1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .active {
            border-bottom: 3px solid burlywood;
        }

        .select2-container {
            width: 100%!important;
        }


        element.style {
        }
        .table td, .table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
            padding: 4px !important;
            font-size: 0.85em;
            color: black;
            border-top: none !important;
        }

    </style>


    {{-- Select 2 --}}
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>

    <!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div id="page-wrapper" class="gray-bg dashbard-1">
        <!-- Start content -->
        <div class="content-main">

            <div style="width: 1050px" class="container">

                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3>Manage Marksheet Generate</h3>
                            </div>

                            <div class="panel-body"  width="880" height="900">
                                <div class="clearfix">
                                    <div class="row">
                                        <div style="border: 1px solid;padding: 10px 0px 10px!important;" class="col-md-12 text-center pt-5">Student Marksheet</div>
                                        <div style="border: 1px solid;margin-top: 19px;" class="col-md-12">
                                            <div class="col-md-3  text-center">
                                                <img style="width:50%;" src="{{url('scl/scl_logo.png')}}">
                                            </div>
                                            <div style="padding-top: 25px" class="col-md-6 text-center">
                                                <h4 style="padding: 2px">ABC School</h4>
                                                <h5 style="padding: 2px">Chittagong,Bangladesh</h5>
                                                <h5 style="padding: 2px">subratanath186@gmail.com</h5>
                                                <h5 style="padding: 2px"><strong><u>Academic Transcript</u></strong></h5>
                                                <h5 style="padding: 2px">{{$allMarks[0]['exam_type']['name']}}</h5>
                                            </div>
                                            <div class="col-md-3  text-center">
                                                <img style="width:50%;" src="{{url('scl/scl_logo.png')}}">
                                            </div>

                                            <div class="col-md-12">
                                                @php
                                                    $date = new DateTime('now',new DateTimezone('Asia/Dhaka'));
                                                @endphp

                                                <i  style="font-size: 12px;float: right">Printing Time : {{$date->format('F j,Y, g:i a')  }}</i>
                                            </div>


                                            <div style="padding-top: 174px">
                                                <div class="col-md-6">

                                                    <table border="1" width="100%" class="table" cellpadding="9" cellspacing="2">
                                                        @php
                                                            $assign_student = App\model\assignstudent::where('year_id',$allMarks[0]->year_id)
                                                                                                    ->where('class_id',$allMarks[0]->class_id)
                                                                                                    ->first();


                                                        @endphp

                                                        <tr>
                                                            <td width="50%" style="padding: 13px!important">Student Name</td>
                                                            <td width="50%" style="padding: 13px!important">{{$allMarks[0]['studentData']['name']}}</td>
                                                        </tr>

                                                        <tr>
                                                            <td width="50%" style="padding: 13px!important">Student ID</td>
                                                            <td width="50%" style="padding: 13px!important">{{$allMarks[0]['id_no']}}</td>
                                                        </tr>

                                                        <tr>
                                                            <td width="50%" style="padding: 13px!important">Roll No</td>
                                                            <td width="50%" style="padding: 13px!important">{{$assign_student->roll}}</td>
                                                        </tr>

                                                        <tr>
                                                            <td width="50%" style="padding: 13px!important">Class</td>
                                                            <td width="50%" style="padding: 13px!important">{{$allMarks[0]['class']['name']}}</td>
                                                        </tr>

                                                        <tr>
                                                            <td width="50%" style="padding: 13px!important">Session</td>
                                                            <td width="50%" style="padding: 13px!important">{{$allMarks[0]['year']['name']}}</td>
                                                        </tr>

                                                    </table>
                                                </div>
                                                <div class="col-md-6">
                                                    <table border="1" width="100%" class="table text-center" cellspacing="1" cellpadding="1">
                                                        <thead>
                                                        <tr>
                                                            <th style="text-align: center">Letter Grade</th>
                                                            <th style="text-align: center">Marks Interval</th>
                                                            <th style="text-align: center">Grade Point</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        @foreach($allGrade as $marks)
                                                            <tr>
                                                                <td>{{$marks->grade_name}}</td>
                                                                <td>{{$marks->start_mark}} - {{$marks->end_mark}}</td>
                                                                <td>{{number_format((float)$marks->start_point,2)}} - {{number_format((float)$marks->end_point,2) }}</td>
                                                            </tr>
                                                        @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>

                                            <div class="col-md-12" style="margin: 25px 0px;">
                                                <table border="1" class="table">
                                                    <thead>
                                                    <tr>
                                                        <th class="text-center">SL</th>
                                                        <th class="text-center">Subject</th>
                                                        <th class="text-center">Full Marks</th>
                                                        <th class="text-center">Get Marks</th>
                                                        <th class="text-center">Letter Grade</th>
                                                        <th class="text-center">Grade Point</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @php
                                                        $totalMarks = 0;
                                                        $totalPoint = 0;
                                                     @endphp

                                                    @foreach($allMarks as $key=>$mark)
                                                        @php
                                                        $getMarks = $mark->marks;
                                                        $totalMarks = (float)$totalMarks+(float)$getMarks;
                                                        $totalSubject =App\model\marksEntry::where('student_id',$mark->student_id)->where('year_id',$mark->year_id)
                                                                                        ->where('class_id',$mark->class_id)
                                                                                        ->where('exam_type_id',$mark->exam_type_id)->get()->count();

                                                        @endphp
                                                        <tr>
                                                            <td class="text-center">{{$key+1}}</td>
                                                            <td class="text-center">{{$mark['assign_subject']['subject']['name']}}</td>
                                                            <td class="text-center">{{$mark['assign_subject']['full_marks']}}</td>
                                                            <td class="text-center">{{$getMarks}}</td>
                                                        @php
                                                        $grade_marks = App\model\MarksGrade::where([['start_mark','<=',(int)$getMarks],['end_mark','>=',(int)$getMarks]])->first();
                                                        $gradeName = $grade_marks->grade_name;
                                                        $gradePoint = number_format((float)$grade_marks->grade_point,2);
                                                        $totalPoint = (float)$totalPoint+(float)$gradePoint;
                                                        @endphp
                                                            <td class="text-center">{{$gradeName}}</td>
                                                            <td class="text-center">{{$gradePoint}}</td>
                                                        </tr>
                                                    @endforeach
                                                        <tr>
                                                            <td colspan="3"><strong style="padding-left: 30px">Total Marks</strong></td>
                                                            <td colspan="3" style="padding-left: 37px"><strong>{{$totalMarks}}</strong></td>
                                                        </tr>

                                                    </tbody>
                                                </table>
                                            </div>
                                            <br/>

                                            <div class="col-md-12" style="margin-bottom: 20px">
                                                <table border="1" class="table">
                                                    <tbody>
                                                    @php
                                                    $total_grade = 0;
                                                    $point_for_latter_grade = (float)$totalPoint/(float)$totalSubject;
                                                    $total_grade = App\model\MarksGrade::where([['start_point','<=',$point_for_latter_grade],['end_point','>=',$point_for_latter_grade]])->first();
                                                    $grade_point_avg = (float)$totalPoint/(float)$totalSubject;

                                                    @endphp
                                                        <tr>
                                                            <td width="50%"><strong>Grade Point Average</strong></td>
                                                            <td width="50%">
                                                                @if($count_fail>0)
                                                                    0.00
                                                                @else
                                                                    {{number_format((float)$grade_point_avg,2)}}
                                                                @endif
                                                            </td>
                                                        </tr>
                                                    <tr>
                                                        <td width="50%">Letter Grade</td>
                                                        <td width="50%">
                                                            @if($count_fail>0)
                                                                F
                                                            @else
                                                                {{$total_grade->grade_name}}
                                                            @endif
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td width="50%">Total Marks With Fraction</td>
                                                        <td width="50%"><strong>{{$totalMarks}}</strong></td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <br/>



                                        </div>
                                    </div>
                                </div>

                                <br/>
                                <br/>




                                <div style="margin-top: 10px" class="row">
                                    <div style="width: 25%;float: right;">
                                        <hr style="margin: 0;padding: 0">
                                        <p style="text-align: center">Head Master Signature</p>
                                    </div>
                                </div>


                             




                            </div>

                        
                        </div> <!-- col-12 -->

                    </div> <!-- End Row -->


                </div> <!-- container -->

            </div><!-- content -->
        </div><!-- content-page -->
  

@endsection



