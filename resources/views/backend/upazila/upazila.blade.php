
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
                                    Upazila List

                                    <a style="float: right" class="btn btn-success" href="{{ route('upazila.add') }}"> <i class="fa fa-plus-circle" aria-hidden="true"></i> Add Upazila </a>
                                      
                                        
                                    </div>

                                    <div class="panel-body">
                                        @if(Session::has('message'))
                                            <div class="alert alert-danger">
                                                {{Session::get('message')}}
                                            </div>
                                        @endif

                                        <div class="row">
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                <table id="" class="table table-striped table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th width="10%">#SL</th>
                                                            <th>District Name</th>
                                                            <th>Upazila Name</th>
                                                            <th width="15%">Action </th>
                                                        </tr>
                                                    </thead>

                                                    <tbody>
                                                        @foreach($division as $key=>$item)

                                                        <?php
                
                                                        $id = App\Upazila::where('division_id',$item->division_id)->select('district_id')->groupBy('district_id')->get();
                                                        
                                                        
                                                        ?>

                                                            <tr class="{{  (count($id)>1)?'':$id[0]->district_id }}">
                                                                <th style="border-bottom: 2px solid gray" class="text-center" colspan="4">
                                                                 <strong style="border: 2px solid gray;padding: 10px;">
                                                                    Division Name : {{ $item['division']['name']}}
                                                                </strong> 
                                                                    </th>
                                                            </tr>
  
                                                            <?php
                                                                $district = App\Upazila::where('division_id',$item->division_id)->select('district_id')->groupBy('district_id')->get();
                                                            ?>

                                                        
                                                            @foreach($district as $key=>$name)
                                                                <?php
                                                                    $upazilaName = App\Upazila::where('district_id',$name->district_id)->select('name')->get();

                                                                    $check = App\union::where('district_id',$name->district_id)->first();
                                                                ?>

                                                                <tr class="{{ $name->district_id }}">
                                                                    <td>{{ $key+1}}</td> 
                                                                    <td>{{ $name['district']['name']}}</td> 
                                                                    <td>
                                                                    @foreach($upazilaName as $key=>$upazila)
                                                                        {{ $upazila->name}},
                                                                    @endforeach
                                                                    </td> 
                                                                    <td>
                                                                        <a href="{{route('upazila.edit',$name->district_id)}}" class="btn btn-info "><i class="fa fa-edit"></i></a>
                                                                    @if($check==null)
                                                                        <a title="Delete" style="background-color: #c0ff05" class="btn btn-success delete" href="{{ route('upazila.delete') }}" data-token="{{ csrf_token() }}" data-id="{{ $name->district_id }}"> <i class="fa fa-trash" aria-hidden="true"></i></a></a>
                                                                    @endif
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        
                                                        @endforeach
                                                    <tbody>
                                                <table>

                                                {!! $division->links() !!}


                                              

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
                    

                    setTimeout(function () {
                        window.location.reload(1);
                    }, 1000);
                    
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