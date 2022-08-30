<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="admin/js/jquery.min.js"></script>

    <!-- Base Css Files -->
    <link href="css/bootstrap.min.css" rel="stylesheet" />
    
    <title>Student Registration Card</title>

  
</head>
<body>
    <div class="panel-body">
      
        <div class="clearfix">

            <table class="table m-t-30 border-dark text-center">
                <tr>
                    <th>
                       
                        <img style="width:15%;" src="scl/scl_logo.png">
                    </th>
                    <td>
                        <div>
                            <h3>ABC School</h3>
                            <h4>Chittagong,Bangladesh</h4>
                            <h4>subratanath186@gmail.com</h4>
                        </div>
                    </td>
                    <th>
                        <img style="width: 15%;" src="{{ $details['studentData']['image'] }}">
                    </th>
                    
                </tr>

                    <thead>
                        <tr>
                            <th style="text-align: center;padding: 10px" colspan="3">Student Registration Card</th>
                        </tr>
                    </thead>
            </table>


        </div>


        <hr>
       

        <div class="m-h-50"></div>
       
            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table border="1" class="table m-t-30 border-dark text-center">
                        
                            <tbody>

                                <tr>
                                    <td style="padding: 10px">Name</td>
                                    <td style="padding: 10px">{{ $details['studentData']['name'] }}</td>                           
                                </tr>

                                <tr>
                                    <td style="padding: 10px">Father Name</td>
                                    <td style="padding: 10px">{{ $details['studentData']['fname'] }}</td>                           
                                </tr>

                                <tr>
                                    <td style="padding: 10px">Mother Name</td>
                                    <td style="padding: 10px">{{ $details['studentData']['mname'] }}</td>                           
                                </tr>

                                <tr>
                                    <td style="padding: 10px">Year</td>
                                    <td style="padding: 10px">{{ $details['year']['name'] }}</td>                           
                                </tr>

                                <tr>
                                    <td style="padding: 10px">Class</td>
                                    <td style="padding: 10px">{{ $details['class']['name'] }}</td>                           
                                </tr>

                                <tr>
                                    <td style="padding: 10px">ID No</td>
                                    <td style="padding: 10px">{{ $details['studentData']['id_no'] }}</td>                           
                                </tr>

                                <tr>
                                    <td style="padding: 10px">Roll</td>
                                    <td style="padding: 10px">{{ $details->roll }}</td>                           
                                </tr>

                                <tr>
                                    <td style="padding: 10px">Mobile Number</td>
                                    <td style="padding: 10px">{{ $details['studentData']['mobile'] }}</td>                           
                                </tr>

                                <tr>
                                    <td style="padding: 10px">Address</td>
                                    <td style="padding: 10px">{{ $details['studentData']['address'] }}</td>                           
                                </tr>

                                <tr>
                                    <td style="padding: 10px">Gender</td>
                                    <td style="padding: 10px">{{ $details['studentData']['gender'] }}</td>                           
                                </tr>

                                <tr>
                                    <td style="padding: 10px">Religion</td>
                                    <td style="padding: 10px">{{ $details['studentData']['religion'] }}</td>                           
                                </tr>

                                <tr>
                                    <td style="padding: 10px">Dath Of Birth</td>
                                    <td style="padding: 10px">                   
                                    {{ Carbon\Carbon::createFromTimestamp($details['studentData']['dob'])->format('d/m/Y') }}
                                    </td>                           
                                </tr>


                            </tbody>

                            
                        </table>
                    </div>
                </div>
            </div>


            @php
            $date = new DateTime('now',new DateTimezone('Asia/Dhaka'));
            @endphp

            <i>Printing Time : {{$date->format('F j,Y, g:i a')  }}</i>
            
            <hr>

            <div style="margin-top: 50px" class="row">
             
    
                <div style="width: 25%;float: right;">
                    <hr style="margin: 0;padding: 0">
                    <p style="text-align: center">Head Master Signature</p>
                </div>
            </div>
           
            

    
    </div>

</body>
</html>