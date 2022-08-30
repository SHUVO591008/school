
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
                                       Assign Subject(Class) : {{ $view[0]['class']['name'] }}

                                       <a style="float: right" class="btn btn-success" href="{{ route('students.assign.subject.view') }}"> <i class="fa fa-list" aria-hidden="true"></i> All Assign Class List </a>

                                    </div>
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-md-12 col-sm-12 col-xs-12">


                                                <table class="table table-striped table-bordered">
                                                
                                                    <thead>
                                                        <tr>
                                                            <th width="10%">#SL</th>
                                                            <th>Subject</th>
                                                            <th>Full Marks</th>
                                                            <th>Pass Marks</th>
                                                            <th>Subjective Marks</th>
                                                        </tr>
                                                    </thead>

                                             
                                                   
                                                    <tbody> 
                                                        <?php $sl = 1 ;?>

                                                        @foreach ($view as $item)
                                                            <tr class="{{ $item->id }}">
                                                                <td>{{ $sl++ }}</td>
                                                                
                                                                <td>
                                                                    {{ $item['subject']['name'] }}
                                                                </td>
                                                                <td>{{ $item->full_marks }}</td>
                                                                <td>{{ $item->pass_marks }}</td>
                                                                <td>{{ $item->subjective_marks }}</td>

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