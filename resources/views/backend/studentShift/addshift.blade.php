
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
                                        @if(@isset($editData))
                                            Edit Students Shift
                                        @else
                                            Add Student Shift
                                        @endif

                                        <a style="float: right" class="btn btn-success" href="{{ route('students.shift.view') }}"> <i class="fa fa-list" aria-hidden="true"></i> Student Shift List </a>
                                       
                                        
                                    </div>

                                    <div style="background: #fff" class="panel-body">
                                        <div class="row">
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                <form method="post" id="myForm" action="@if(@isset($editData)){{ route('students.shift.update',$editData->id) }}@else{{ route('students.shift.store') }}@endif">
                                                    @csrf
                                                    <div class="form-row">
                                                       
                                                        <div class="form-group col-md-6">
                                                            <label style="color: black">Shift Name</label>
                                                            <input id="name" placeholder="Shift Name" type="text" name="name" value="@if(@isset($editData)){{ $editData->name }}@else{{ old('name') }}@endif" class="form-control" autocomplete="off" >
                                                            <span id="firstNameError" style="color: red"></span>

                                                            @error('name')
                                                                <span style="color: red;font-size: 12px" class="invalid-feedback error" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                             @enderror
                                                        </div>


                                                        <div class="form-group col-md-12">
                                                            <input class="btn btn-primary" type="submit" value="@if(@isset($editData)) Update @else Save @endif">
                                                        </div>


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

    function checkfirstname(){
        var firstName = $("#name").val();
        var reg = /^[a-zA-Z -.]{6,55}$/;

        var test =$("#name").attr("type");

        if(reg.test(firstName)){
            $("#firstNameError").text("")
            return true;
        }else {
            $("#firstNameError").text("Year formate is invalid.")
            return false;
        }
    }

    $("#name").keyup(function () {
            checkfirstname()
    });


    $("#myForm").submit(function () {
        if(checkfirstname() == true){
            return true;
        }else {
            return false;
        }
    });



</script>  



@endsection