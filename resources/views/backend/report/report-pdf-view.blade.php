<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="admin/js/jquery.min.js"></script>

    <!-- Base Css Files -->
    <link href="css/bootstrap.min.css" rel="stylesheet" />

    <title>Monthly/Yearly Profit/Loss</title>


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
                        </div>
                    </td>
                    <th>
                        <img style="width:20%;" src="scl/scl_logo.png">
                        {{-- <img style="width: 20%;" src="{{ $totalattgroupbyid['0']['user']['image'] }}"> --}}
                    </th>
                </tr>
                    <thead>
                        <tr>
                            <th style="text-align: center;" colspan="3">Monthly/Yearly-Profit/Loss </th>
                            <hr>
                        </tr>
                    </thead>
            </table>
        </div>


        <div class="col-md-12">

            <?php

            $student_fee = App\model\accountstudentfee::whereBetween('date',[$s_date,$e_date])->sum('amount');
            $other_cost = App\model\cost::whereBetween('expense_date',[$star_date,$end_date])->sum('amount');
            $employee_salary = App\model\AccountEmployeeSalary::whereBetween('date',[$s_date,$e_date])->sum('amount');

            $total_cost = $other_cost+$employee_salary;
            $profit = $student_fee-$total_cost;

            if($total_cost>$profit){
                $remarks = "Loss";
            }elseif($total_cost==$profit){
                $remarks = "Equal";
            }else{
                $remarks = "Profit";
            }

            ?>



            <div class="table-responsive">
                <table border="1" class="table border-dark text-center">
                    <tbody>
                        <tr>
                            <td colspan="2" style="text-align: center;padding: 10px;"><h4 style="font-weight: bold">Reporting Date : {{ date('d-M-Y',strtotime($star_date)) }} To {{ date('d-M-Y',strtotime($end_date)) }}</h4></td>
                        </tr>
                        <tr>
                            <td style="width:50%"><h4 style="font-weight: bold">Purpose</h4></td>
                            <td style="padding: 10px"><h4 style="font-weight: bold">Amount</h4></td>
                        </tr>

                        <tr>
                            <td style="padding: 10px;">Student Fee</td>
                            <td style="padding: 10px">{{ number_format($student_fee,2) }} Tk</td>
                        </tr>

                        <tr>
                            <td style="padding: 10px;">Employee Sallary</td>
                            <td style="padding: 10px">{{ number_format($employee_salary,2) }} Tk</td>
                        </tr>

                        <tr>
                            <td style="padding: 10px;">Other Cost</td>
                            <td style="padding: 10px">{{ number_format($other_cost,2) }} Tk</td>
                        </tr>



                        <tr>
                            <td style="padding: 10px">Total Cost</td>
                            <td style="padding: 10px">{{ number_format($total_cost,2) }} Tk</td>
                        </tr>

                        <tr>
                            <td style="padding: 10px;font-weight: bold" >Profit/Loss</td>
                            <td style="padding: 10px;font-weight: bold">{{ number_format($profit,2) }} Tk ({{$remarks}})</td>
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
