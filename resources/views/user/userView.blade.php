
@extends('layouts.app')


@section('web')


{{-- <link href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/buttons/1.6.5/css/buttons.dataTables.min.css" rel="stylesheet"> --}}
{{-- <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script> --}}
<script type="text/javascript" src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.print.min.js"></script>


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
                                       User List

                                        @if (Auth::user()->role=="Admin")
                                             <a style="float: right" class="btn btn-success" href="{{ route('users.add') }}"> <i class="fa fa-plus-circle" aria-hidden="true"></i> Add User </a>
                                        @endif

                                  
                                   
                                        
                                        
                                    </div>

                                 

                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                <table id="example" class="table table-striped table-bordered">
                                                
                                                    <thead>
                                                        <tr>
                                                            <th>#SL</th>
                                                            <th>Role</th>
                                                            <th>Name</th>
                                                            <th>Email</th>
                                                            <th>Code</th>
                                                                                                            
                                                            <th>Photo </th>
                                                            <th>Action </th>
                                                        </tr>
                                                    </thead>

                                             
                                                    <tbody> 
                                                        <?php $sl = 1 ?>
                                                        
                                                        @foreach ($user as $item)
                                                            <tr>

                                                                
                                                                <td>{{ $sl++ }}</td>
                                                                <td>{{ $item->role }}</td>
                                                                <td>{{ $item->name }}</td>
                                                                <td>{{ $item->email }}</td>
                                                                <td>
                                                                    @if ($item->code==null)
                                                                        <span style="color: red">Password Change</span>
                                                                    @endif
                                                                    {{ $item->code }}
                                                                </td>
                                                               
                                                               
                                                                <td>
                                                                    <img class="img-circle" style="width: 80px; height:80px" src="{{(!empty($item->image))?url($item->image):url('profile/avatar.png') }}""/>

                                                                  
                                                                </td>
                                                                <td>

                                                               
                                                                    <a href="{{route('users.edit',$item->id)}}" class="btn btn-info "><i class="fa fa-edit"></i>
                                                                     </a>
                                                               
                                                                    <a href="{{route('users.delete',$item->id)}}" class="btn btn-danger delete-confirm"><i class="fa fa-trash" aria-hidden="true"></i>
                                                                    </a>
                                                              

                                                                    <a href="{{route('users.single',encrypt($item->id))}}" class="btn btn-primary " ><i class="fa fa-eye" aria-hidden="true"></i>
                                                                     </a>

                                                                </td>
                                                                
                                                            </tr>
                                                        @endforeach
                        
                                                    </tbody>
                                                </table>

                                            </div>
                                        </div> <!-- End Row panal -->
                                    </div>

                              

            @if($currentUserInfo)
                <h4>IP: {{ $currentUserInfo->ip }}</h4>
                <h4>Country Name: {{ $currentUserInfo->countryName }}</h4>
                <h4>Country Code: {{ $currentUserInfo->countryCode }}</h4>
                <h4>Region Code: {{ $currentUserInfo->regionCode }}</h4>
                <h4>Region Name: {{ $currentUserInfo->regionName }}</h4>
                <h4>City Name: {{ $currentUserInfo->cityName }}</h4>
                <h4>Zip Code: {{ $currentUserInfo->zipCode }}</h4>
                <h4>Latitude: {{ $currentUserInfo->latitude }}</h4>
                <h4>Longitude: {{ $currentUserInfo->longitude }}</h4>
            @endif
                                

                                </div> <!-- panel -->
                            </div> <!-- col-12 -->
                            
                        </div> <!-- End Row -->


                    </div> <!-- container -->
                </div><!-- content -->
            </div><!-- content-page -->


    
{{-- excel --}}
<script type="text/javascript">

$(document).ready(function() {
    $('#example').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    } );
});




    // var _gaq = _gaq || [];
    // _gaq.push(['_setAccount', 'UA-36251023-1']);
    // _gaq.push(['_setDomainName', 'jqueryscript.net']);
    // _gaq.push(['_trackPageview']);
  
    // (function() {
    //   var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    //   ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    //   var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
    // })();
  
  </script>



@endsection