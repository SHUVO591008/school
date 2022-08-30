<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="admin/js/jquery.min.js"></script>

    <!-- Base Css Files -->
    <link href="css/bootstrap.min.css" rel="stylesheet" />
    
    <title>Employee Monthly Salary</title>

  
</head>
<body>
    <div class="panel-body">
        <div class="clearfix">

            <?php

            $date = date('Y-m',strtotime($totalattgroupbyid['0']->date));
            if($date !==''){
                $where[] =['date','like',$date.'%'];
            }

            foreach ($totalattgroupbyid as $key => $v) {
            $totalatt = App\model\EmployeAttendence::with(['user'])->where($where)->where('employee_id',$v->employee_id)->get();

            $absentcount = count($totalatt->where('att_stutas','Absent'));
            $attdaycount= count($totalatt);
            $salary = (int)$totalattgroupbyid['0']['user']['salary'];
            $salaryperday = $salary/30;
            $salaryminus = (int)$absentcount*(int)$salaryperday;
            $salarydaywisetotal =$salaryperday*$attdaycount;
            
            $totalsalary = (int)$salarydaywisetotal-$salaryminus;
            }
           

            ?>

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
                        </div>
                    </td>
                    <th>
                        <img style="width: 20%;" src="{{ $totalattgroupbyid['0']['user']['image'] }}">
                    </th>
                </tr>
                    <thead>
                        <tr>
                            <th style="text-align: center;" colspan="3">Monthly Of Salary : {{ date('F-Y',strtotime( $totalattgroupbyid['0']->date)) }}</th>
                        </tr>
                    </thead>
            </table>
        </div>
        <div class="col-md-12">
            <div class="table-responsive">
                <table border="1" class="table border-dark text-center">
                    <tbody>
                        <tr>
                            <td style="padding: 10px;">Employee Name</td>
                            <td style="padding: 10px">{{ $totalattgroupbyid['0']['user']['name'] }}</td>                           
                        </tr>

                        <tr>
                            <td style="padding: 10px;">Employee ID</td>
                            <td style="padding: 10px">{{ $totalattgroupbyid['0']['user']['id_no'] }}</td>                           
                        </tr>

                        <tr>
                            <td style="padding: 10px;">Disgnation</td>
                            <td style="padding: 10px">
                            <?php 
                                $postition = App\model\designation::where('id',$totalattgroupbyid['0']['user']['designation_id'])->first()->name;
                                echo  $postition;
                            ?>
                                
                            </td>                           
                        </tr>

                        <tr>
                            <td style="padding: 10px;">Joining Date</td>
                            <td style="padding: 10px">{{ date('d-M-Y',strtotime($totalattgroupbyid['0']['user']['join_date'])) }}</td>                           
                        </tr>

                       

                        <tr>
                            <td style="padding: 10px">Total absent For this month</td>
                            <td style="padding: 10px">{{ $absentcount }} Day</td>                           
                        </tr>

                        <tr>
                            <td style="padding: 10px">Total Salary Count</td>
                            <td style="padding: 10px">{{ $attdaycount }} Day</td>                           
                        </tr>

                        <tr>
                            <td style="padding: 10px">Month</td>
                            <td style="padding: 10px">{{ date('M-Y',strtotime( $totalattgroupbyid['0']->date)) }}</td>                           
                        </tr>

                        <tr>
                            <td style="padding: 10px">Basic Salary</td>
                            <td style="padding: 10px">{{ number_format($totalattgroupbyid['0']['user']['salary'], 0, '.', ',') }}/- TK</td>
                                     
                        </tr>

                        <tr>
                            <td style="padding: 10px">Absent Salary</td>
                            <td style="padding: 10px">{{ number_format($salaryminus, 0, '.', ',') }}/- TK</td>
                                     
                        </tr>

                        <tr>
                            <td style="padding: 10px">Total Salary for this month</td>
                            <td style="padding: 10px">{{ number_format($totalsalary, 1, '.', ',') }}/- TK</td>                           
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