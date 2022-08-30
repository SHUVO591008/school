<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="admin/js/jquery.min.js"></script>

    <!-- Base Css Files -->
    <link href="css/bootstrap.min.css" rel="stylesheet" />

    <title>All Student Marksheet</title>

</head>
<body>
<div class="panel-body">
    <div class="clearfix">


        <table class="table border-dark text-center">
            <tr>
                <th>
                    <img style="width:20%;" src="scl/scl_logo.png">
                </th>
                <td>
                    <div>
                        <h4>ABC School</h4>
                        <h5>Chittagong,Bangladesh</h5>
                        <h5>subratanath186@gmail.com</h5>
                        <h5>Result Of : {{$allMarks[0]['exam_type']['name']}}</h5>
                    </div>
                </td>
                <th>

                    <img style="width:20%;" src="scl/scl_logo.png">
                </th>
            </tr>
            <thead>
            <tr>
                <th style="text-align: center;" colspan="3">All Student Marksheet  </th>
            </tr>
            </thead>
        </table>



        <div class="col-md-12">

            <table border="1" width="100%" class="table" cellpadding="9" cellspacing="2">

                <tbody>
                    <tr>
                        <td width="50%" style="padding: 13px!important">Year/Session : {{$allMarks[0]['year']['name'] }}</td>

                        <td width="50%" style="padding: 13px!important">Class :{{$allMarks[0]['class']['name']}}</td>
                    </tr>
                </tbody>

            </table>
        </div>
        <div class="col-md-12">
            <table border="1" width="100%" class="table text-center" cellspacing="1" cellpadding="1">
                <thead>
                    <tr>
                        <th style="text-align: center">SL</th>
                        <th style="text-align: center">Student Name</th>
                        <th style="text-align: center">ID No</th>
                        <th style="text-align: center">Latter Grade</th>
                        <th style="text-align: center">Greade Point</th>
                        <th style="text-align: center">Remarks</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($allMarks as $key=> $marks)

                @php
                    $totalMarks = 0;
                    $total_point = 0;
                    $allMark = App\model\marksEntry::where('class_id',$marks->class_id)
                                                    ->where('year_id',$marks->year_id)
                                                    ->where('exam_type_id',$marks->exam_type_id)
                                                    ->where('student_id',$marks->student_id)
                                                    ->get();



                     foreach($allMark as $value){

                        $count_fail = App\model\marksEntry::where('year_id',$value->year_id)
                                        ->where('class_id',$value->class_id)->where('exam_type_id',$value->exam_type_id)
                                        ->where('student_id',$value->student_id)
                                        ->where('marks','<','33')->get()->count();


                        $get_marks = $value->marks;

                        $grade_marks = App\model\MarksGrade::where([['start_mark','<=',(int)$get_marks],['end_mark','>=',(int)$get_marks]])->first();


                        $grade_name = $grade_marks->grade_name;
                        $grade_point = number_format((float)$grade_marks->grade_point,2);

                        $total_point = (float)$total_point+(float)$grade_point;


                        }


                @endphp

                    <tr>
                        <td width="10%">{{ $key+1 }}</td>
                        <td width="20%">{{ $marks['studentData']['name'] }}</td>
                        <td width="20%">{{ $marks['studentData']['id_no'] }}</td>
                        @php

                        $totalSubject =App\model\marksEntry::where('student_id',$value->student_id)
                                                            ->where('year_id',$value->year_id)
                                                            ->where('class_id',$value->class_id)
                                                            ->where('exam_type_id',$value->exam_type_id)->get()->count();
                        $total_grade = 0;
                        $point_for_latter_grade = (float)$total_point/(float)$totalSubject;


                        $total_grade = App\model\MarksGrade::where([['start_point','<=',$point_for_latter_grade],['end_point','>=',$point_for_latter_grade]])->first();

                        $grade_point_avg = (float)$total_point/(float)$totalSubject;

                        @endphp

                        <td width="20%">
                            @if($count_fail > 0)
                                F
                            @else
                            {{$total_grade->grade_name}}
                            @endif
                        </td>
                        <td width="20%">
                            @if($count_fail>0)
                                0.00
                            @else
                                {{number_format((float)$grade_point_avg,2)}}
                            @endif
                        </td>

                        <td width="20%">
                            @if($count_fail>0)
                                Fail
                            @else
                                {{$total_grade->remarks}}
                            @endif
                        </td>

                    </tr>



                @endforeach
                </tbody>
            </table>
        </div>



    </div>


    @php
        $date = new DateTime('now',new DateTimezone('Asia/Dhaka'));
    @endphp

    <i>Printing Time : {{$date->format('F j,Y, g:i a')  }}</i>
    <div style="margin-top: 10px" class="row">
        <div style="width: 25%;float: right;">
            <hr style="margin: 0;padding: 0">
            <p style="text-align: center">Head Master Signature</p>
        </div>
    </div>




</div>

</body>
</html>
