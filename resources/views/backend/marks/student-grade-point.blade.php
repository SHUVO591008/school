
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
                                       Grade Point Details

                                       <a style="float: right" class="btn btn-success" href="{{ route('marks.grade.add') }}"> <i class="fa fa-plus-circle" aria-hidden="true"></i> Grade Point Entry</a>

                                    </div>
                                    <div class="panel-body">

                                    <hr>
                                        <div class="row">
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                <table id="datatable" class="table table-striped table-bordered">

                                                    <thead>
                                                        <tr>
                                                            <th width="10%">#SL</th>
                                                            <th>Grade Name</th>
                                                            <th>Grade Point</th>
                                                            <th>Start Marks</th>
                                                            <th>End Marks</th>
                                                            <th>Point Range</th>
                                                            <th>Remarks</th>
                                                            <th>Action</th>

                                                        </tr>
                                                    </thead>


                                                    <tbody>
                                                        <?php $sl = 1

                                                        ?>

                                                        @foreach ($allData as $item)
                                                            <tr class="{{ $item->id }}">
                                                                <td>{{ $sl++ }}</td>
                                                                <td>{{ $item->grade_name }}</td>
                                                                <td>{{ number_format($item->grade_point,2)  }}</td>
                                                                <td>{{ $item->start_mark }}</td>
                                                                <td>{{ $item->end_mark }}</td>
                                                                <td>{{ number_format($item->start_point,2) }} - {{ number_format($item->end_point,2) }}</td>
                                                                <td>{{ $item->remarks }}</td>
                                                                <td>
                                                                    <a href="{{ route('marks.grade.edit',$item->id) }}" class="btn btn-info" title="Edit"><i class="fa fa-edit"></i> </a>
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

