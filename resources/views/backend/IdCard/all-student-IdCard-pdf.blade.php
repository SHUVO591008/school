<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="admin/js/jquery.min.js"></script>

    <!-- Base Css Files -->
    <link href="css/bootstrap.min.css" rel="stylesheet" />

    <title>Student ID Card</title>

    <style>
        .container {
            width: 70%!important;
        }
    </style>

</head>
<body>
<div class="panel-body">
    <div class="clearfix">


       <div class="container">
            @foreach ($AllId as $item)
            <table style="border: 1px solid black"; class="table border-dark text-center">
                <tr>
                    <td style="text-align: left">
                        <img style="width:20%;padding: 10px;" src="scl/scl_logo.png">
                    </td>
                    <td>
                        <div>
                            <h4 style="color: red">ABC School</h4>
                            <h5 style="font-weight: 800!important">ID Card</h5>
                        </div>
                    </td>
                    <td style="text-align:right;padding: 10px">
                        <img style="width:20%;height: 20%;" src="{{$item['studentData']['image']}}">
                    </td>
                </tr>

                <tr>
                    <td style="text-align: left;padding: 10px">Name: {{$item['studentData']['name'] }}</td>
                    <td></td>
                    <td style="text-align: right;padding: 10px">ID No: {{ $item['studentData']['id_no'] }}</td>
                </tr>

                <tr>
                    <td style="text-align: left;padding: 10px">Session: {{$item['year']['name'] }}</td>
                    <td style="text-align: center;padding: 10px">Class: {{ $item['class']['name'] }}</td>
                    <td style="text-align: right;padding: 10px">Roll : {{ $item->roll }}</td>
                </tr>

                <tr>
                    <td style="text-align: left;padding: 10px">Mobile No : {{$item['studentData']['mobile']}}</td>
                </tr>

                <tr>
                    <td></td>
                    <td></td>
                    <td style="text-align: right;padding: 10px">

                        <div style="margin-top: 10px" class="row">
                            <div style="width: 25%;float: right;">
                                <hr style="margin: 0;padding: 0">
                                <p style="text-align: center">Head Master Signature</p>
                            </div>

                        </div>
                    </td>
                </tr>

            </table>
            @endforeach
       </div>


    </div>


 


</div>

</body>
</html>
