
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
                                       Manage Employee Salary
                                    </div>
                                    <div class="panel-body">
                                        <h4 style="text-align: center;padding:10px">Employee Salary List</h4>
                                    <hr>
                                        <div class="row">
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                <table id="datatable" class="table table-striped table-bordered">
                                                
                                                    <thead>
                                                        <tr>
                                                            <th width="3%">#SL</th>
                                                            <th>Name</th>
                                                            <th width="10%">Disgnation</th>
                                                            <th>ID No</th>
                                                            <th>Mobile</th>
                                                            <th>Address</th>
                                                            <th>Gender</th>
                                                            <th>Join Date</th>
                                                            <th>Salary</th>
                                                           
                                                            <th width="15%">Action </th>
                                                        </tr>
                                                    </thead>

                                             
                                                    <tbody> 
                                                        <?php $sl = 1 ?>
                                                        
                                                        @foreach ($allData as $item)
                                                            <tr class="{{ $item->id }}">
                                                                <td>{{ $sl++ }}</td>
                                                                <td>{{ $item->name }}</td>
                                                                <td>{{ $item['designation']['name'] }}</td>
                                                                <td>{{ $item->id_no }}</td>
                                                                <td>{{ $item->mobile }}</td>
                                                                <td>{{ $item->address }}</td>
                                                                <td>{{ $item->gender }}</td>
                                                                <td>{{ date('d-M-Y',strtotime($item->join_date)) }}</td>
                                                                <td>{{number_format($item->salary, 0, '.', ',')}}</td>
                                                                
                                                                <td>
                                                                    <a title="Salary Increment" href="{{route('employe.salary.increment',$item->id)}}" class="btn btn-warning"><i class="fa fa-plus-circle"></i>
                                                                     </a>

                                                                     <a title="Details" href="{{route('employe.salary.single',$item->id)}}" class="btn btn-warning btn-outline-primary"><i class="fa fa-eye"></i>
                                                                     </a>
                                                                </td>
                                                                
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

