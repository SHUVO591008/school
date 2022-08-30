
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
                                           Grade Point Entry
                                        <a style="float: right" class="btn btn-success" href="{{ route('marks.grade.view') }}"> <i class="fa fa-list" aria-hidden="true"></i> Grade Point View </a>
                                       
                                        
                                    </div>

                                    <div style="background: #fff" class="panel-body">
                                        <div class="row">
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                <form method="post" id="myForm" action="@if(@isset($editData)){{ route('marks.grade.update',$editData->id) }}@else{{ route('marks.grade.store') }}@endif">
                                                    @csrf

                                                    <div class="form-group col-md-4">
                                                        <label style="color: black">Grade Name</label>
                                                        <input id="grade_name" placeholder="Grade name" type="text" name="grade_name" value="@if(@isset($editData)){{ $editData->grade_name }}@else{{ old('grade_name') }}@endif" class="form-control" autocomplete="off" >
                                                   

                                                        @error('grade_name')
                                                            <span style="color: red;font-size: 12px" class="invalid-feedback error" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                         @enderror

                                                    </div>

                                                    <div class="form-group col-md-4">
                                                        <label style="color: black">Grade Point</label>
                                                        <input id="grade_point" placeholder="Grade Point" type="text" name="grade_point" value="@if(@isset($editData)){{ $editData->grade_point }}@else{{ old('grade_point') }}@endif" class="form-control" autocomplete="off" >
                                                   

                                                        @error('grade_point')
                                                            <span style="color: red;font-size: 12px" class="invalid-feedback error" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                         @enderror
                                                         
                                                    </div>

                                                    <div class="form-group col-md-4">
                                                        <label style="color: black">Start Marks</label>
                                                        <input id="start_mark" placeholder="Start Marks" type="text" name="start_mark" value="@if(@isset($editData)){{ $editData->start_mark }}@else{{ old('start_mark') }}@endif" class="form-control" autocomplete="off" >
                                                   

                                                        @error('start_mark')
                                                            <span style="color: red;font-size: 12px" class="invalid-feedback error" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                         @enderror
                                                         
                                                    </div>

                                                    <div class="form-group col-md-4">
                                                        <label style="color: black">End Marks</label>
                                                        <input id="end_mark" placeholder="End Marks" type="text" name="end_mark" value="@if(@isset($editData)){{ $editData->end_mark }}@else{{ old('end_mark') }}@endif" class="form-control" autocomplete="off" >
                                                   

                                                        @error('end_mark')
                                                            <span style="color: red;font-size: 12px" class="invalid-feedback error" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                         @enderror
                                                         
                                                    </div>


                                                    <div class="form-group col-md-4">
                                                        <label style="color: black">Start Point</label>
                                                        <input id="start_point" placeholder="Start Point" type="text" name="start_point" value="@if(@isset($editData)){{ $editData->start_point }}@else{{ old('start_point') }}@endif" class="form-control" autocomplete="off" >
                                                   

                                                        @error('start_point')
                                                            <span style="color: red;font-size: 12px" class="invalid-feedback error" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                         @enderror
                                                         
                                                    </div>

                                                    <div class="form-group col-md-4">
                                                        <label style="color: black">End Point</label>
                                                        <input id="end_point" placeholder="End Point" type="text" name="end_point" value="@if(@isset($editData)){{ $editData->end_point }}@else{{ old('end_point') }}@endif" class="form-control" autocomplete="off" >
                                                   

                                                        @error('end_point')
                                                            <span style="color: red;font-size: 12px" class="invalid-feedback error" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                         @enderror
                                                         
                                                    </div>


                                                    <div class="form-group col-md-4">
                                                        <label style="color: black">Remarks</label>
                                                        <input id="remarks" placeholder="Remarks" type="text" name="remarks" value="@if(@isset($editData)){{ $editData->remarks }}@else{{ old('remarks') }}@endif" class="form-control" autocomplete="off" >
                                                   

                                                        @error('remarks')
                                                            <span style="color: red;font-size: 12px" class="invalid-feedback error" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                         @enderror
                                                         
                                                    </div>
                                                   

                                                    <div class="form-group col-md-12">
                                                        <input id="storeButton" class="btn btn-primary" type="submit" value="@if(@isset($editData)) Update @else Save @endif">
                                                    </div>

                                         </form>

                                              
                                                   
                                            </div>
                                        </div> <!-- End Row panal -->
                                    </div>

                                </div> <!-- panel -->
                            </div> <!-- col-12 -->
                            
                        </div> <!-- End Row -->


                    </div> <!-- container -->
                    
                </div><!-- content -->
            </div><!-- content-page -->



{{-- validation --}}
<script>

    //store validation
    $(document).on('click','#storeButton',function(){

    var grade_name = $("#grade_name").val();
    var grade_point = $("#grade_point").val();
    var start_mark = $("#start_mark").val();
    var end_mark = $("#end_mark").val();
    var start_point = $("#start_point").val();
    var end_point = $("#end_point").val();
    var remarks = $("#remarks").val();
    
    if(grade_name==''){
        $.notify("please type the Grade name", {globalPosition:'top right',className:'error'});
        return false;
    }

    if(grade_point==''){
        $.notify("please type the Grade Point", {globalPosition:'top right',className:'error'});
        return false;
    }

    if(start_mark==''){
        $.notify("please type the Start Mark", {globalPosition:'top right',className:'error'});
        return false;
    }

    if(end_mark==''){
        $.notify("please type the End Mark", {globalPosition:'top right',className:'error'});
        return false;
    }

    if(start_point==''){
        $.notify("please type the Start Point", {globalPosition:'top right',className:'error'});
        return false;
    }

    if(end_point==''){
        $.notify("please type the End Point", {globalPosition:'top right',className:'error'});
        return false;
    }

    if(remarks==''){
        $.notify("please type the Remarks", {globalPosition:'top right',className:'error'});
        return false;
    }


    



   
    });

   

//store validation End
</script>


@endsection