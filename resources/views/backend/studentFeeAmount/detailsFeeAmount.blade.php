
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
                                       Student Fee Amount Datails : {{ $view[0]['feeCategory']['name'] }}

                                       <a style="float: right" class="btn btn-success" href="{{ route('students.fee.amount.view') }}"> <i class="fa fa-list" aria-hidden="true"></i> All Fee List </a>

                                    </div>
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-md-12 col-sm-12 col-xs-12">


                                                <table class="table table-striped table-bordered">
                                                
                                                    <thead>
                                                        <tr>
                                                            <th width="10%">#SL</th>
                                                            <th>Class Name</th>
                                                            <th width="10%">Amount</th>
                                                        </tr>
                                                    </thead>

                                             
                                                   
                                                    <tbody> 
                                                        <?php 
                                                            $sl = 1 ;
                                                            $total_sum = '0';
                                                        ?>

                                                        
                                                        
                                                        @foreach ($view as $item)
                                                            <tr class="{{ $item->id }}">
                                                                <td>{{ $sl++ }}</td>
                                                                
                                                                <td>
                                                                    {{ $item['class']['name'] }}
                                                                </td>
                                                                <td style="text-align: center">
                                                                    {{ $item->amount }}
                                                                </td>
                                                              
                                                               <?php
                                                                $total_sum += $item->amount;
                                                               ?>
                                                            </tr>
                                                        
                                                        @endforeach

                                                        <tr colspan="2">
                                                            <td><strong>Total</strong></td>
                                                            
                                                            <td></td>
                                                            <td style="text-align: center"><strong>{{ $total_sum }}</strong></td>
                                                        </tr>
                        
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