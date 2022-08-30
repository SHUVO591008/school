<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="admin/js/jquery.min.js"></script>

    <!-- Base Css Files -->
    <link href="css/bootstrap.min.css" rel="stylesheet" />

    <title>Employee Attendence</title>


</head>
<body>
<div class="panel-body">
    <div class="clearfix">

        <?php



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
                    <img style="width: 20%;" src="{{ $allData['0']['user']['image'] }}">
                </th>
            </tr>
            <thead>
            <tr>
                <th style="text-align: center;" colspan="3">Employee Attendence Report </th>
            </tr>
            </thead>
        </table>
    </div>
    <div class="col-md-12">
        <strong>Employee Name :</strong>{{$allData['0']['user']['name']}},<strong>ID No :</strong>{{$allData['0']['user']['id_no']}},
        <strong>Month :</strong>{{$month}}
        <div class="table-responsive">
            <table border="1" class="table border-dark text-center">
                <thead >
                <tr>
                    <th style="text-align: center">Date</th>
                    <th style="text-align: center">Attendence Status</th>
                </tr>
                </thead>
                <tbody>
               @foreach($allData as $value)
                   <tr>
                       <td style="padding: 10px;">{{ date('d-m-Y',strtotime($value->date)) }}</td>
                       <td style="padding: 10px">{{ $value->att_stutas }}</td>
                   </tr>
               @endforeach

                <tr>
                    <td colspan="2">
                        <strong style="font-weight: bold">Total Absent :</strong>{{$absent}},<strong style="font-weight: bold">Total Leave</strong> :{{$Leave}}
                    </td>

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
