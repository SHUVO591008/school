
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

                                    @if (isset($errors) && $errors->any())
                                            <div class="alert alert-danger">
                                                <ul>
                                                    @foreach ($errors->all() as $error)
                                                        <li style="list-style: none">{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                    @endif 

                                    <div class="panel-heading">
                                       Manage Student Fee Amount

                                       <a style="float: right" class="btn btn-success" href="{{ route('students.fee.amount.add') }}"> <i class="fa fa-plus-circle" aria-hidden="true"></i> Add Fee Amount </a>

                                    </div>
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-md-12 col-sm-12 col-xs-12">


                                                <table id="datatable" class="table table-striped table-bordered">
                                                
                                                    <thead>
                                                        <tr>
                                                            <th width="10%">#SL</th>
                                                            <th>Student Fee Category</th>
                                                            
                                                            <th width="15%">Action </th>
                                                        </tr>
                                                    </thead>

                                             
                                                    <tbody> 
                                                        <?php $sl = 1 ?>
                                                        
                                                        @foreach ($data as $item)
                                                            <tr class="{{ $item->id }}">
                                                                <td>{{ $sl++ }}</td>
                                                                <td>
                                                                    {{ $item['feeCategory']['name'] }}
                                                                </td>
                                                                <td>
                                                                    <a id="edit" href="{{route('students.fee.amount.edit',$item->fee_category_id)}}" class="btn btn-info "><i class="fa fa-edit"></i>
                                                                     </a>

                                                                     <a id="View" style="background-color: #c0ff05"  href="{{route('students.fee.amount.category.view',$item->fee_category_id) }}" class="btn btn-info "><i class="fa fa-eye"></i>
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