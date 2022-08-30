
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
                                       Manage Employee Leave

                                       <a style="float: right" class="btn btn-success" href="{{ route('employe.leave.add') }}"> <i class="fa fa-plus-circle" aria-hidden="true"></i> Add Employee Leave</a>

                                    </div>
                                    <div class="panel-body">
                                        <h4 style="text-align: center;padding:10px">Employee Leave List</h4>
                                    <hr>
                                        <div class="row">
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                <table id="datatable" class="table table-striped table-bordered">
                                                
                                                    <thead>
                                                        <tr>
                                                            <th width="5%">#SL</th>
                                                            <th>Name</th>
                                                            <th>ID No</th>
                                                            <th>Purpose</th>
                                                            <th>Date</th>
                                                            <th>Day</th>
                                                            <th width="17%">Action </th>
                                                        </tr>
                                                    </thead>

                                             
                                                    <tbody> 
                                                        <?php $sl = 1 
                                                        
                                                        ?>
                                                        
                                                        @foreach ($allData as $item)
                                                            <tr class="{{ $item->id }}">
                                                                <td>{{ $sl++ }}</td>
                                                                <td>{{ $item['userData']['name'] }}</td>
                                                                <td>{{ $item['userData']['id_no'] }}</td>
                                                                <td>{{ $item['purpose']['name'] }}</td>
                                                                <td>{{ date('d-M-Y',strtotime($item->start_date)) }} To {{ date('d-M-Y',strtotime($item->end_date)) }}
                                                                </td>
                                                                <td>
                                                                  <?php
                                                                  
                                                                    $start_date = \Carbon\Carbon::createFromFormat('Y-m-d', $item->start_date);
                                                                    $end_date = \Carbon\Carbon::createFromFormat('Y-m-d', $item->end_date);
                                                                    $different_days = $start_date->diffInDays($end_date);

                                                                    echo $different_days+1 .' day';
                                                                       
                                                                    ?>
                                                                </td>
                                                             
                                                                <td>
                                                                    <a id="edit" href="{{route('employe.leave.edit',$item->id)}}" class="btn btn-info "><i class="fa fa-edit"></i>
                                                                     </a>

                                                                     <a title="Details" target="_blank" id="edit" href="{{route('employe.reg.single',$item->id)}}" class="btn btn-info btn-outline-primary"><i class="fa fa-eye"></i>
                                                                     </a>

                                                                     <a title="Delete" style="background-color: #c0ff05" class="btn btn-success delete" href="{{ route('employe.reg.delete') }}" data-token="{{ csrf_token() }}" data-id="{{ $item->id }}"> <i class="fa fa-trash" aria-hidden="true"></i></a>

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
                               

{{-- Delete --}}
<script>
    $('.delete').on('click', function (event) {
        
    event.preventDefault();
    var action = $(this).attr('href');
    var token = $(this).attr('data-token');
    var id = $(this).attr('data-id');
    swal({
        title: 'Are you sure Delete?',
        text: 'Delete Ok!',
        icon: 'warning',
        buttons: ["Cancel", "Yes!"],
    }).then(function(value) {

        if (value) {
            $.ajax({
                url:action,
                type:'post',
                data:{id:id, _token:token},
                
                success:function(data){
                   
                    swal({
                        title: 'Delete!',
                        type: 'success',
                    });
                    
                    if(value){
                        $('.' + id).fadeOut();
                    }
                    
                }
            });
            
        }else{
            swal("Cancelled","","error");
        }

    });
    return false;
    });
</script>
{{-- delete --}}


@endsection

