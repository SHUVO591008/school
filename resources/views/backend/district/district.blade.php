
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
                                    District List

                                    <a style="float: right" class="btn btn-success" href="{{ route('district.add') }}"> <i class="fa fa-plus-circle" aria-hidden="true"></i> Add District </a>
                                      
                                        
                                    </div>

                                    <div class="panel-body">
                                         @if(Session::has('message'))
                                                <div class="alert alert-danger">
                                                    {{Session::get('message')}}
                                                </div>
                                            @endif

                                          

                                        <div class="row">
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                <table id="datatable" class="table table-striped table-bordered">
                                                
                                                    <thead>
                                                        <tr>
                                                            <th width="10%">#SL</th>
                                                            <th>Division Name</th>
                                                            <th>District Name</th>
                                                            <th width="15%">Action </th>
                                                        </tr>
                                                    </thead>

                                             
                                                    <tbody> 
                                                        <?php $sl = 1 ?>
                                                        
                                                        @foreach ($division as $item)
                                                            <tr class="{{ $item->division_id }}">
                                                                <td>{{ $sl++ }}</td>
                                                                <td>{{ $item['division']['name']}}</td>
                                                                <td>
                                                                <?php 
                                             
                                                                $allData = App\District::where('division_id',$item->division_id)->select('name')->get();

                                                                $check = App\Upazila::where('division_id',$item->division_id)->first();

                                                                ?>

                                                                @foreach ($allData as $name)

                                                                {{ $name->name}},

                                                                @endforeach

                                                                
                                                                </td>
                                                                <td>
                                                                    <a href="{{route('district.edit',$item->division_id)}}" class="btn btn-info "><i class="fa fa-edit"></i>
                                                                     </a>
                                                                     @if($check==null)
                                                                     <a title="Delete" style="background-color: #c0ff05" class="btn btn-success delete" href="{{ route('district.delete') }}" data-token="{{ csrf_token() }}" data-id="{{ $item->division_id }}"> <i class="fa fa-trash" aria-hidden="true"></i></a></a>
                                                                    @endif

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
                               
<!-- delete -->
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
 <!-- delete  -->


@endsection