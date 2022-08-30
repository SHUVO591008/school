
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
                                       Student Fee Category List

                                       <a style="float: right" class="btn btn-success" href="{{ route('students.fee.category.add') }}"> <i class="fa fa-plus-circle" aria-hidden="true"></i> Add Fee Category </a>

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
                                                        
                                                        @foreach ($fee as $item)
                                                            <tr class="{{ $item->id }}">
                                                                <td>{{ $sl++ }}</td>
                                                                <td>
                                                                    {{ $item->name }}
                                                                </td>
                                                                <td>
                                                                    <a id="edit" href="{{route('students.fee.category.edit',$item->id)}}" class="btn btn-info "><i class="fa fa-edit"></i>
                                                                     </a>

                                                                     <a title="Delete" style="background-color: #c0ff05" class="btn btn-success delete" href="{{ route('students.fee.category.delete') }}" data-token="{{ csrf_token() }}" data-id="{{ $item->id }}"> <i class="fa fa-trash" aria-hidden="true"></i></a>
                                                               
                                                                    
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