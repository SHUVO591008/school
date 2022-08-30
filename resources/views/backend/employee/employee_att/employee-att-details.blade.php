
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
                                       Employee Attendence Details

                                       <a style="float: right" class="btn btn-success" href="{{ route('employe.attendences.view') }}"> <i class="fa fa-plus-circle" aria-hidden="true"></i> Employee Attendence List</a>

                                    </div>
                                    <div class="panel-body">
                                        <h4 style="text-align: center;padding:10px">Employee Attendence Details- ({{ date('d-M-Y',strtotime($details[0]['date'])) }})</h4>
                                    <hr>
                                        <div class="row">
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                <table id="datatable" class="table table-striped table-bordered">
                                                
                                                    <thead>
                                                        <tr>
                                                            <th width="10%">#SL</th>
                                                            <th>Name</th>
                                                            <th>Id No</th>
                                                            <th>Attendence Status</th>
                                                            
                                                        </tr>
                                                    </thead>

                                             
                                                    <tbody> 
                                                        <?php $sl = 1 
                                                        
                                                        ?>
                                                        
                                                        @foreach ($details as $item)
                                                            <tr class="{{ $item->id }}">
                                                                <td>{{ $sl++ }}</td>
                                                                <td>{{ $item['user']['name'] }}</td>
                                                                <td>{{ $item['user']['id_no'] }}</td>
                                                                <td>{{ $item->att_stutas }}</td>
                                                                
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

