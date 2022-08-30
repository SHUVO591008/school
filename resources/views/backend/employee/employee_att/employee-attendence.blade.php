
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
                                       Manage Employee Attendence

                                       <a style="float: right" class="btn btn-success" href="{{ route('employe.attendences.add') }}"> <i class="fa fa-plus-circle" aria-hidden="true"></i> Take Attendence</a>

                                       <a style="float: right" title="Details All" href="{{route('attendences.details.all')}}" class="btn btn-warning btn-outline-primary"><i class="fa fa-align-center"></i> 
                                        Date Wise Attendence
                                       </a>

                                    </div>
                                    <div class="panel-body">
                                        <h4 style="text-align: center;padding:10px">Employee Attendence List</h4>
                                    <hr>
                                        <div class="row">
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                <table id="datatable" class="table table-striped table-bordered">
                                                
                                                    <thead>
                                                        <tr>
                                                            <th width="10%">#SL</th>
                                                            <th>Date</th>
                                                            <th width="20%">Action </th>
                                                        </tr>
                                                    </thead>

                                             
                                                    <tbody> 
                                                        <?php $sl = 1 
                                                        
                                                        ?>
                                                        
                                                        @foreach ($allData as $item)
                                                            <tr class="{{ $item->id }}">
                                                                <td>{{ $sl++ }}</td>
                                                                <td>{{ date('d-m-Y',strtotime($item->date)) }}</td>
                                                             
                                                                <td>
                                                                    <a id="edit" href="{{route('employe.attendences.edit',$item->date)}}" class="btn btn-info "><i class="fa fa-edit"></i>
                                                                     </a>

                                                                     <a title="Details" href="{{route('employe.attendences.details',$item->date)}}" class="btn btn-success btn-outline-primary"><i class="fa fa-eye"></i>
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

