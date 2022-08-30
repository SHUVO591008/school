

@extends('layouts.app')


@section('web')

{{-- date Picker --}}
<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

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
                                            Promotion Students
                                            
                                        @else
                                            Add Student
                                        @endif

                                        <a style="float: right" class="btn btn-success" href="{{ route('student.reg.view') }}"> <i class="fa fa-list" aria-hidden="true"></i> Student List </a>
                                       
                                        
                                    </div>

                                    <div style="background: #fff" class="panel-body">
                                        <div class="row">
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                <form method="post" id="myForm" action="{{ route('student.promotion.store',$editData->id) }}" enctype="multipart/form-data">
                                                    @csrf
                                                    <div style="height: 100px" class="form-row">
                                                        <div class="form-group col-md-4">
                                                            <label style="color: black">Student Name</label>
                                                            <input id="sudent_name" placeholder="Name" type="text" name="name" value="@if(@isset($editData)){{ $editData['studentData']['name'] }}@else{{ old('name') }}@endif" class="form-control" autocomplete="off" readonly>
                                                            <span id="studentName" style="color: red"></span>

                                                            @error('name')
                                                                <span style="color: red;font-size: 12px" class="invalid-feedback error" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                             @enderror
                                                        </div>


                                                        <div class="form-group col-md-4">
                                                            <label style="color: black">Father's Name</label>
                                                            <input id="fname" placeholder="Father's Name" type="text" name="fname" value="@if(@isset($editData)){{ $editData['studentData']['fname'] }}@else{{ old('fname') }}@endif" class="form-control" autocomplete="off" readonly>
                                                            <span id="f_name" style="color: red"></span>

                                                            @error('fname')
                                                                <span style="color: red;font-size: 12px" class="invalid-feedback error" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                             @enderror
                                                        </div>

                                                        <div class="form-group col-md-4">
                                                            <label style="color: black">Mother's Name</label>
                                                            <input id="mname" placeholder="Mother's Name" type="text" name="mname" value="@if(@isset($editData)){{ $editData['studentData']['mname'] }}@else{{ old('mname') }}@endif" class="form-control" autocomplete="off" readonly>
                                                            <span id="m_name" style="color: red"></span>

                                                            @error('mname')
                                                                <span style="color: red;font-size: 12px" class="invalid-feedback error" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                             @enderror
                                                        </div>

                                                    </div> 

                                                    <div style="height: 100px" class="from-row">
                                                        <div class="form-group col-md-4">
                                                            <label style="color: black">Mobile Number</label>
                                                            <input id="mobile" placeholder="Mobile Number" type="text" name="mobile" value="@if(@isset($editData)){{ $editData['studentData']['mobile'] }}@else{{ old('mobile') }}@endif" class="form-control" autocomplete="off" readonly>
                                                            <span id="mobile_no" style="color: red"></span>

                                                            @error('mobile')
                                                                <span style="color: red;font-size: 12px" class="invalid-feedback error" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                             @enderror
                                                        </div>

                                                        <div  class="form-group col-md-4">
                                                            <label style="color: black">Address</label>
                                                            <input id="address" placeholder="Address" type="text" name="address" value="@if(@isset($editData)){{ $editData['studentData']['address'] }}@else{{ old('address') }}@endif" class="form-control" autocomplete="off" readonly>
                                                            <span id="stu_address" style="color: red"></span>

                                                            @error('address')
                                                                <span style="color: red;font-size: 12px" class="invalid-feedback error" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                             @enderror
                                                        </div>

                                                        <div class="form-group col-md-4">
                                                            <label style="color: black">Gender</label>
                                                            <select name="gender" class="form-control" id="gender" disabled>
                                                                <option selected disabled>Select Gender</option>
                                                                <option @if(@isset($editData)){{ ($editData['studentData']['gender']=='Male')?"selected":"" }}@endif
                                                                value="Male">Male</option>

                                                                <option @if(@isset($editData)){{ ($editData['studentData']['gender']=='Female')?"selected":"" }}@endif value="Female">Female</option>
                                                            </select>
                                                           
                                                            <span id="gender1" style="color: red"></span>

                                                            @error('gender')
                                                                <span style="color: red;font-size: 12px" class="invalid-feedback error" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                             @enderror
                                                        </div>
                                                    </div>

                                                    <div style="height: 100px" class="from-row">
                                                        <div class="form-group col-md-4">
                                                            <label style="color: black">Religion</label>
                                                            <select name="religion" class="form-control" id="religion" disabled>
                                                                <option selected disabled>Select Religion</option>
                                                                <option @if(@isset($editData)){{ ($editData['studentData']['religion']=='hindu')?"selected":"" }}@endif value="hindu">Hindu</option>
                                                                <option @if(@isset($editData)){{ ($editData['studentData']['religion']=='muslim')?"selected":"" }}@endif  value="muslim">Muslim</option>
                                                                <option @if(@isset($editData)){{ ($editData['studentData']['religion']=='christen')?"selected":"" }}@endif   value="christen">Christen</option>
                                                            </select>
                                                           
                                                            <span id="religion1" style="color: red"></span>

                                                            @error('religion')
                                                                <span style="color: red;font-size: 12px" class="invalid-feedback error" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                             @enderror
                                                        </div>

                                                        <div class="form-group col-md-4">
                                                            <label style="color: black">Date Of Birth</label>
                                                            <input type="text" name="dob" value="{{ Carbon\Carbon::createFromTimestamp($editData['studentData']['dob'])->format('d/m/Y') }}" class="form-control" autocomplete="off" readonly>
                                                            <span id="stu_dob" style="color: red"></span>

                                                            @error('dob')
                                                                <span style="color: red;font-size: 12px" class="invalid-feedback error" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                             @enderror
                                                        </div>

                                                        <div class="form-group col-md-4">
                                                            <label style="color: black">Discount %</label>
                                                            <input id="discount" placeholder="Discount" type="text" name="discount" value="@if(@isset($editData)){{ $editData['studentdiscount']['discount'] }}@else{{ old('discount') }}@endif" class="form-control" autocomplete="off" >
                                                            <span id="stu_discount" style="color: red"></span>

                                                            @error('discount')
                                                                <span style="color: red;font-size: 12px" class="invalid-feedback error" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                             @enderror
                                                        </div>
                                                    </div>

                                                    <div style="height: 100px" class="from-row">
                                                        <div class="form-group col-md-4">
                                                            <label style="color: black">Class</label>
                                                            <select name="class_id" class="form-control" id="stu_class">
                                                                <option selected disabled>Select Class</option>
                                                                @foreach ($class as $item)
                                                                <option @if(@isset($editData)){{ ($editData->class_id==$item->id )?"selected":"" }}@endif  value="{{ $item->id }}">{{ $item->name }}</option>
                                                                @endforeach
                                                            </select>
                                                           
                                                            <span id="class_id" style="color: red"></span>

                                                            @error('class_id')
                                                                <span style="color: red;font-size: 12px" class="invalid-feedback error" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                             @enderror
                                                        </div>

                                                        <div class="form-group col-md-4">
                                                            <label style="color: black">Year</label>
                                                            <select name="year_id" class="form-control" id="year">
                                                                <option selected disabled>Select Year</option>
                                                                @foreach ($year as $item)
                                                                <option @if(@isset($editData)){{ ($editData->year_id==$item->id )?"selected":"" }}@endif value="{{ $item->id }}">{{ $item->name }}</option>
                                                                @endforeach
                                                            </select>
                                                           
                                                            <span style="color: red" id="year_id">
                                                                
                                                            </span>

                                                            @error('year_id')
                                                                <span style="color: red;font-size: 12px" class="invalid-feedback error" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                             @enderror
                                                        </div>

                                                        <div class="form-group col-md-4">
                                                            <label style="color: black">Group</label>
                                                            <select name="group_id" class="form-control" id="group">
                                                                <option selected disabled>Select Group</option>
                                                                @foreach ($group as $item)
                                                                <option @if(@isset($editData)){{ ($editData->group_id==$item->id )?"selected":"" }}@endif value="{{ $item->id }}">{{ $item->name }}</option>
                                                                @endforeach
                                                            </select>
                                                           
                                                            <span style="display: none;color: red" id="group_id">
                                                                Group formate is invalid.
                                                            </span>

                                                            @error('group_id')
                                                                <span style="color: red;font-size: 12px" class="invalid-feedback error" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                             @enderror
                                                        </div>
                                                    </div>

                                                    <div style="height: 100px" class="from-row">
                                                        <div class="form-group col-md-4">
                                                            <label style="color: black">Shift</label>
                                                            <select name="shift_id" class="form-control" id="shift">
                                                                <option selected disabled>Select Shift</option>
                                                                @foreach ($shift as $item)
                                                                <option @if(@isset($editData)){{ ($editData->shift_id==$item->id )?"selected":"" }}@endif value="{{ $item->id }}">{{ $item->name }}</option>
                                                                @endforeach
                                                            </select>
                                                           
                                                            <span id="shift_id" style="color: red"></span>

                                                            @error('shift_id')
                                                                <span style="color: red;font-size: 12px" class="invalid-feedback error" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                             @enderror
                                                        </div>

                                                        

                                                        <div class="form-group col-md-4">
                                                            <label style="color: black">Image</label>
                                                            <img style="width: 100px;height: 110px; border: 1px solid gray" id="image" 
                                                            src="@if(@isset($editData)){{ url($editData['studentData']['image']) }}@else{{ url('profile/No-image-found.jpg') }}@endif" />
                                                        </div>
                                                    </div>
                                                        

                                                    <div class="form-group col-md-12">
                                                        <input class="btn btn-primary" type="submit" value="@if(@isset($editData)) Promotion @else Save @endif">
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


     //  Discount
     function discount(){
        var discount = $("#discount").val();
        var reg = /^([0-9]|([1-9][0-9])|100)$/;
        // var test =$("#discount").attr("type");

        
        if(discount ==''){
            return true;
        }else{
            if(reg.test(discount)){
                $("#stu_discount").text("")
                return true;
            }else {
                $("#stu_discount").text("Discount formate is invalid.")
                return false;
            }
           
        }

       
    }


    $("#discount").keyup(function () {
        discount()
    });

    //  class
    function class1(){
        var class_id = $("#stu_class").val();
        var reg = /[0-9]|\./;

        // var test =$("#stu_class").attr("type");

        if(reg.test(class_id)){
            $("#class_id").text("")
            return true;
        }else {
            $("#class_id").text("Class formate is invalid.")
            return false;
        }
        
        
    }

    $("#stu_class").change(function () {
        class1()
    });

     //  year
     function year(){
        var year = $("#year").val();
        var reg = /[0-9]|\./;

        // var test =$("#year").attr("type");

        if(reg.test(year)){
            $("#year_id").text("")
            return true;
        }else {
            $("#year_id").text("Year formate is invalid.")
            return false;
        }
        
        
    }

    $("#year").change(function () {
        year()
    });

    //  group
    function group(){
        var group = $("#group").val();
        var reg = /[0-9]|\./;

        if(group==null){
            return true; 
        }else{
           if(reg.test(group)){
            $("#group_id").hide()
            return true;
        }else {
            $("#group_id").show()
            return false;
        }
        }
        

        
        
    }

    $("#group").change(function () {
        group()
    });

     //  shift
     function shift(){
        var shift = $("#shift").val();
        var reg = /[0-9]|\./;

        // var test =$("#shift").attr("type");

        

        if(reg.test(shift)){
            $("#shift_id").text("")
            return true;
        }else {
            $("#shift_id").text("Shift formate is invalid.")
            return false;
        }
        
        
    }

    $("#shift").change(function () {
        shift()
    });



    $("#myForm").submit(function () {
        if(discount() == true & class1() == true & year() == true & group() == true & shift() == true){
            return true;
        }else {
            return false;
        }
    });



</script>     



@endsection