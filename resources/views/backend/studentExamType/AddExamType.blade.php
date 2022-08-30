
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
                                            Edit Student Exam Type
                                        @else
                                            Add Student Exam Type
                                        @endif

                                        <a style="float: right" class="btn btn-success" href="{{ route('students.exam.type.view') }}"> <i class="fa fa-list" aria-hidden="true"></i> Student Exam Type List </a>
                                       
                                        
                                    </div>

                                    <div style="background: #fff" class="panel-body">
                                        <div class="row">
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                <form method="post" id="myForm" action="@if(@isset($editData)){{ route('students.exam.type.update',$editData->id) }}@else{{ route('students.exam.type.store') }}@endif">
                                                    @csrf
                                                    <div class="form-row">
                                                       
                                                        <div class="form-group col-md-6">
                                                            <label style="color: black">Exam Name</label>
                                                            <input id="name" placeholder="Exam Name" type="text" name="name" value="@if(@isset($editData)){{ $editData->name }}@else{{ old('name') }}@endif" class="form-control" autocomplete="off" >
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
        var reg = /^[0-9a-zA-Z -.]{3,55}$/;
        
        var test =$("#name").attr("type");

        if(reg.test(firstName)){
            $("#firstNameError").text("")
            return true;
        }else {
            $("#firstNameError").text("Exam Name formate is invalid.")
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