
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
                                       Soft Delete 
                                    </div>

                                    <form action="{{ route('store') }}" method="post">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-4">
                                                <input name="name" type="text" class="form-control" placeholder="Name">
                                            </div>
                                            <div class="col-md-12">
                                                <button type="submit" class="btn btn-danger">Save</button>
                                            </div>

                                        </div>
                                    </form>


                                    <div class="row">
                                        <div class="col-md-12">
                                            <table class="table table-striped table-inverse table-responsive">
                                                <thead class="thead-inverse">
                                                    <tr>
                                                        <th>SL</th>
                                                        <th>Name</th>
                                                        <th>Action</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>

                                                      @foreach ($allData as $key => $item)
                                                        <tr>
                                                            <td scope="row">{{ $key+1 }}</td>
                                                            <td>{{ $item->name }}</td>
                                                            <td>
                                                                <a href="{{ route('delete',$item->id) }}" class="btn btn-danger">Soft Delete</a>
                                                            </td>
                                                        </tr>
                                                      @endforeach
                                                       
                                                    </tbody>
                                            </table>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <h3 class="text-center">Soft Delete Data</h3>
                                        <div class="col-md-12">
                                            <table class="table table-striped table-inverse table-responsive">
                                                <thead class="thead-inverse">
                                                    <tr>
                                                        <th>SL</th>
                                                        <th>Name</th>
                                                        <th>Action</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>

                                                      @foreach ($data as $key => $item)
                                                        <tr>
                                                            <td scope="row">{{ $key+1 }}</td>
                                                            <td>{{ $item->name }}</td>
                                                           
                                                            <td>
                                                                <a href="{{ route('restore',$item->id) }}" class="btn btn-danger">Restore</a>

                                                                <a href="{{ route('permanently',$item->id) }}" class="btn btn-danger">Permanently Delete</a>
                                                            </td>
                                                        </tr>
                                                      @endforeach
                                                       
                                                    </tbody>
                                            </table>
                                        </div>
                                    </div>

                                 

                              


                                

                                </div> <!-- panel -->
                            </div> <!-- col-12 -->
                            
                        </div> <!-- End Row -->


                    </div> <!-- container -->
                </div><!-- content -->
            </div><!-- content-page -->


    




@endsection