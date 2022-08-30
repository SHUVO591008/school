
@extends('layouts.app')


@section('web')
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
                                       Employee Salary Details Info

                                       <a style="float: right" class="btn btn-success" href="{{ route('employe.salary.view') }}"> <i class="fa fa-list" aria-hidden="true"></i> Employee Salary List </a>

                                    </div>
                                    <div class="panel-body">
                                      
                                        <h5 style="padding: 5px">Employee Name : {{ $details->name }}</h5>
                                        <h5 style="padding: 5px">ID No : {{ $details->id_no }}</h5>
                                      
                                        <h5 style="padding: 5px">Join Date : {{ date('d-M-Y',strtotime($details->join_date)) }}</h5>
                                        <hr>
                                        <div class="row">
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                <table class="table table-striped table-bordered">
                                                
                                                    <thead>
                                                        <tr>
                                                            
                                                            <th width="10%">#SL</th>
                                                            <th>Previous Salary</th>
                                                            <th>Increment Salary</th>
                                                            <th>Present Salary</th>
                                                            <th>Effected Date</th>
                                                        </tr>
                                                    </thead>

                                                    <tbody> 
                                                        @foreach ($salary_log as $key => $item)
                                                            <tr>
                                                                @if($key=='0')
                                                                <td class="text-center" colspan="5"><strong>Joining Salary : {{ number_format($item->previous_salary, 2, '.', ',') }}</strong></td>
                                                                @else
                                                                <td>{{ $key++ }}</td>
                                                                <td>{{ number_format($item->previous_salary, 2, '.', ',') }}</td>
                                                                <td>{{ number_format($item->incriment_salary, 2, '.', ',') }}</td>
                                                                <td>{{ number_format($item->present_salary, 2, '.', ',') }}</td>
                                                                
                                                                <td>{{ date('d-M-Y',strtotime($item->effected_date)) }}</td>
                                                                @endif
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                   
                                                </table>

                                            </div>
                                        </div> <!-- End Row panal -->
                                    </div>

                                </div> <!-- panel -->
                            </div> <!-- col-12 -->
                            
                        </div> <!-- End Row -->


                    </div> <!-- container -->
                </div><!-- content -->
            </div><!-- content-page -->
                               

@endsection