<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="admin/js/jquery.min.js"></script>

    <!-- Base Css Files -->
    <link href="css/bootstrap.min.css" rel="stylesheet" />
    
    <title>Student Exam Fee</title>

  
</head>
<body>
    <div class="panel-body">
        <div class="clearfix">

            <table class="table border-dark text-center">
                <tr>
                    <th>
                        <img style="width:10%;" src="scl/scl_logo.png">
                    </th>
                    <td>
                        <div>
                            <h4>ABC School</h4>
                            <h5>Chittagong,Bangladesh</h5>
                            <h5>subratanath186@gmail.com</h5>
                        </div>
                    </td>
                    <th>
                        <img style="width: 10%;" src="{{ $std['studentData']['image'] }}">
                    </th>
                </tr>
                    <thead>
                        <tr>
                            <th style="text-align: center;" colspan="3">Student Exam Fee</th>
                        </tr>
                    </thead>
            </table>
        </div>
        <div class="col-md-12">
            <?php
                $registrationFee =  App\model\studentFeeAmount::where('fee_category_id','2')->where('class_id',$std->class_id)->first();
                $originafee = $registrationFee->amount;
                $discount = $std['studentexamdiscount']['discount'];    
                $discountablefee = $discount/100*$originafee;
                $finalFee = (float)$originafee -(float)$discountablefee;
            ?>
            <div class="table-responsive">
                <table border="1" class="table border-dark text-center">
                    <tbody>
                        <tr>
                            <td style="padding: 4px;">ID No</td>
                            <td style="padding: 4px">{{ $std['studentData']['id_no'] }}</td>                           
                        </tr>

                        <tr>
                            <td style="padding: 4px">Roll</td>
                            <td style="padding: 4px">{{ $std->roll }}</td>                           
                        </tr>

                        <tr>
                            <td style="padding: 4px">Name</td>
                            <td style="padding: 4px">{{ $std['studentData']['name'] }}</td>                           
                        </tr>

                        <tr>
                            <td style="padding: 4px">Father Name</td>
                            <td style="padding: 4px">{{ $std['studentData']['fname'] }}</td>                           
                        </tr>

                        <tr>
                            <td style="padding: 4px">Mother Name</td>
                            <td style="padding: 4px">{{ $std['studentData']['mname'] }}</td>                           
                        </tr>

                        <tr>
                            <td style="padding: 4px">Session</td>
                            <td style="padding: 4px">{{ $std['year']['name'] }}</td>                           
                        </tr>

                        <tr>
                            <td style="padding: 4px">Class</td>
                            <td style="padding: 4px">{{ $std['class']['name'] }}</td>                           
                        </tr>

                        <tr>
                            <td style="padding: 4px">Exam Fee</td>
                            <td style="padding: 4px">{{ $originafee }}</td>                           
                        </tr>

                        <tr>
                            <td style="padding: 4px">Discount Fee</td>
                            <td style="padding: 4px">
                            @if ($discount==null)
                                <span>0</span>
                            @endif
                            {{$discount}}%
                            </td>                           
                        </tr>

                        <tr>
                            <td style="padding: 4px">Fee(This Student) of {{ $exam_name }}</td>
                            <td style="padding: 4px">{{ $finalFee }}</td>                           
                        </tr>

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
        
        <hr>

        <div class="clearfix">

            <table class="table border-dark text-center">
                <tr>
                    <th>
                        <img style="width:10%;" src="scl/scl_logo.png">
                    </th>
                    <td>
                        <div>
                            <h4>ABC School</h4>
                            <h5>Chittagong,Bangladesh</h5>
                            <h5>subratanath186@gmail.com</h5>
                        </div>
                    </td>
                    <th>
                        <img style="width: 10%;" src="{{ $std['studentData']['image'] }}">
                    </th>
                </tr>
                    <thead>
                        <tr>
                            <th style="text-align: center;" colspan="3">Student Exam Fee</th>
                        </tr>
                    </thead>
            </table>
        </div>
        <div class="col-md-12">
            <?php
                $registrationFee =  App\model\studentFeeAmount::where('fee_category_id','1')->where('class_id',$std->class_id)->first();
                $originafee = $registrationFee->amount;
                $discount = $std['studentmonthdiscount']['discount'];    
                $discountablefee = $discount/100*$originafee;
                $finalFee = (float)$originafee -(float)$discountablefee;
            ?>
            <div class="table-responsive">
                <table border="1" class="table border-dark text-center">
                    <tbody>
                        <tr>
                            <td style="padding: 4px;">ID No</td>
                            <td style="padding: 4px">{{ $std['studentData']['id_no'] }}</td>                           
                        </tr>

                        <tr>
                            <td style="padding: 4px">Roll</td>
                            <td style="padding: 4px">{{ $std->roll }}</td>                           
                        </tr>

                        <tr>
                            <td style="padding: 4px">Name</td>
                            <td style="padding: 4px">{{ $std['studentData']['name'] }}</td>                           
                        </tr>

                        <tr>
                            <td style="padding: 4px">Father Name</td>
                            <td style="padding: 4px">{{ $std['studentData']['fname'] }}</td>                           
                        </tr>

                        <tr>
                            <td style="padding: 4px">Mother Name</td>
                            <td style="padding: 4px">{{ $std['studentData']['mname'] }}</td>                           
                        </tr>

                        <tr>
                            <td style="padding: 4px">Session</td>
                            <td style="padding: 4px">{{ $std['year']['name'] }}</td>                           
                        </tr>

                        <tr>
                            <td style="padding: 4px">Class</td>
                            <td style="padding: 4px">{{ $std['class']['name'] }}</td>                           
                        </tr>

                        <tr>
                            <td style="padding: 4px">Monthly Fee</td>
                            <td style="padding: 4px">{{ $originafee }}</td>                           
                        </tr>

                        <tr>
                            <td style="padding: 4px">Discount Fee</td>
                            <td style="padding: 4px">
                            @if ($discount==null)
                                <span>0</span>
                            @endif
                            {{$discount}}%
                            </td>                           
                        </tr>

                        <tr>
                            <td style="padding: 4px">Fee(This Student) of {{ $exam_name }}</td>
                            <td style="padding: 4px">{{ $finalFee }}</td>                           
                        </tr>

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