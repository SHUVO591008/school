

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
                                            Edit Employee
                                            
                                        @else
                                            Add Employee
                                        @endif

                                        <a style="float: right" class="btn btn-success" href="{{ route('employe.reg.view') }}"> <i class="fa fa-list" aria-hidden="true"></i> Employee List </a>

                                        
                                    </div>

                                    <div style="background: #fff" class="panel-body">
                                        <div class="row">
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                <form method="post" id="myForm" action="@if(@isset($editData)){{ route('employe.reg.update',$editData->id) }}@else{{ route('employe.reg.store') }}@endif" enctype="multipart/form-data">
                                                    @csrf
                                                    <div style="height: 100px" class="form-row">
                                                        <div class="form-group col-md-4">
                                                            <label style="color: black">Employee Name</label>
                                                            <input id="employee_name1" placeholder="Name" type="text" name="name" value="@if(@isset($editData)){{ $editData->name }}@else{{ old('name') }}@endif" class="form-control" autocomplete="off" >
                                                            <span id="employeeName" style="color: red"></span>

                                                            @error('name')
                                                                <span style="color: red;font-size: 12px" class="invalid-feedback error" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                             @enderror
                                                        </div>

                                                        <div class="form-group col-md-4">
                                                            <label style="color: black">Father's Name</label>
                                                            <input id="fname" placeholder="Father's Name" type="text" name="fname" value="@if(@isset($editData)){{ $editData->fname }}@else{{ old('fname') }}@endif" class="form-control" autocomplete="off" >
                                                            <span id="f_name" style="color: red"></span>

                                                            @error('fname')
                                                                <span style="color: red;font-size: 12px" class="invalid-feedback error" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                             @enderror
                                                        </div>

                                                        <div class="form-group col-md-4">
                                                            <label style="color: black">Mother's Name</label>
                                                            <input id="mname" placeholder="Mother's Name" type="text" name="mname" value="@if(@isset($editData)){{ $editData->mname }}@else{{ old('mname') }}@endif" class="form-control" autocomplete="off" >
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
                                                            <input id="mobile" placeholder="Mobile Number" type="text" name="mobile" value="@if(@isset($editData)){{ $editData->mobile }}@else{{ old('mobile') }}@endif" class="form-control" autocomplete="off" >
                                                            <span id="mobile_no" style="color: red"></span>

                                                            @error('mobile')
                                                                <span style="color: red;font-size: 12px" class="invalid-feedback error" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                             @enderror
                                                        </div>

                                                        <div  class="form-group col-md-4">
                                                            <label style="color: black">Address</label>
                                                            <input id="address" placeholder="Address" type="text" name="address" value="@if(@isset($editData)){{ $editData->address }}@else{{ old('address') }}@endif" class="form-control" autocomplete="off" >
                                                            <span id="stu_address" style="color: red"></span>

                                                            @error('address')
                                                                <span style="color: red;font-size: 12px" class="invalid-feedback error" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                             @enderror
                                                        </div>

                                                        <div class="form-group col-md-4">
                                                            <label style="color: black">Gender</label>
                                                            <select name="gender" class="form-control" id="gender">
                                                                <option selected disabled>Select Gender</option>
                                                                <option @if(@isset($editData)){{ ($editData->gender=='Male')?"selected":"" }}@endif
                                                                value="Male">Male</option>

                                                                <option @if(@isset($editData)){{ ($editData->gender=='Female')?"selected":"" }}@endif value="Female">Female</option>
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
                                                            <select name="religion" class="form-control" id="religion">
                                                                <option selected disabled>Select Religion</option>
                                                                <option @if(@isset($editData)){{ ($editData->religion=='hindu')?"selected":"" }}@endif value="hindu">Hindu</option>
                                                                <option @if(@isset($editData)){{ ($editData->religion=='muslim')?"selected":"" }}@endif value="muslim">Muslim</option>
                                                                <option @if(@isset($editData)){{ ($editData->religion=='christen')?"selected":"" }}@endif value="christen">Christen</option>
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
                                                            <input id="dob" placeholder="Date Of Birth" type="text" name="dob" value="@if(@isset($editData)){{ date('m-d-Y',strtotime($editData->dob)) }}@else 01/01/1998 @endif" class="form-control" autocomplete="off" readonly>
                                                            <span id="stu_dob" style="color: red"></span>

                                                            @error('dob')
                                                                <span style="color: red;font-size: 12px" class="invalid-feedback error" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                             @enderror
                                                        </div>

                                                        <div class="form-group col-md-4">
                                                            <label style="color: black">Disignation</label>
                                                            <select name="designation_id" class="form-control" id="designation">
                                                                <option selected disabled>Select designation</option>
                                                                @foreach ($designation as $item)
                                                                <option @if(@isset($editData)){{ ($editData->designation_id==$item->id )?"selected":"" }}@endif value="{{ $item->id }}">{{ $item->name }}</option>
                                                                @endforeach
                                                            </select>
                                                           
                                                            <span style="color: red" id="designation_id">
                                                                
                                                            </span>

                                                            @error('designation_id')
                                                                <span style="color: red;font-size: 12px" class="invalid-feedback error" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                             @enderror
                                                        </div>

                                                       
                                                    </div>

                                                    <div style="height: 100px" class="from-row">
                                                       
                                                        @if(!@$editData)
                                                        <div class="form-group col-md-3">
                                                            <label style="color: black">Join Date</label>
                                                            <input id="join_date" placeholder="Date Of Birth" type="text" name="join_date" value="@if(@isset($editData)){{ date('m-d-Y',strtotime($editData->join_date)) }}@else 01/01/1998 @endif" class="form-control" autocomplete="off" readonly>
                                                            <span id="employee_join" style="color: red"></span>

                                                            @error('join_date')
                                                                <span style="color: red;font-size: 12px" class="invalid-feedback error" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                             @enderror
                                                        </div>
                                                       
                                                        <div class="form-group col-md-3">
                                                            <label style="color: black">Salary</label>
                                                            <input id="salary" placeholder="Salary" type="text" name="salary" value="@if(@isset($editData)){{ $editData->salary }}@else{{ old('salary') }}@endif" class="form-control" autocomplete="off" >
                                                            <span id="employee_salary" style="color: red"></span>

                                                            @error('salary')
                                                                <span style="color: red;font-size: 12px" class="invalid-feedback error" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                             @enderror
                                                        </div>
                                                        @endif


                                                        <div class="form-group col-md-3">
                                                            <label style="color: black">Image</label>
                                                            <input accept="image/*" type="file" class="form-control @error('image') is-invalid @enderror upload" name="image" onchange="readURL(this);" id="img">
                                                           
                                                            <span id="img_id" style="color: red"></span>

                                                            @error('image')
                                                                <span style="color: red;font-size: 12px" class="invalid-feedback error" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                             @enderror

                                                        </div>

                                                        <div class="form-group col-md-3">
                                                            <img style="width: 100px;height: 110px; border: 1px solid gray" id="image" 
                                                            src="@if(@isset($editData)){{ url($editData->image) }}@else{{ url('profile/No-image-found.jpg') }}@endif" />
                                                        </div>
                                                    </div>
                                                        

                                                    <div class="form-group col-md-12">
                                                        <input class="btn btn-primary" type="submit" value="@if(@isset($editData)) Update @else Save @endif">
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

    //  first-name
    function checkfirstname(){
        var employeename1 = $("#employee_name1").val();
        var reg = /^[a-zA-Z -.]{3,55}$/;

        if(reg.test(employeename1)){
            $("#employeeName").text("")
            return true;
        }else {
            $("#employee_name").css({'border':'1px solid red'});
            $("#employeeName").text("Employee Name formate is invalid.")
            return false;
        }
    }

    $("#employee_name1").keyup(function () {
            checkfirstname()
    });

    //  father-name
    function checkfname(){
        var fname = $("#fname").val();
        var reg = /^[a-zA-Z -.]{3,55}$/;

        // var test =$("#fname").attr("type");

        if(reg.test(fname)){
            $("#f_name").text("")
            return true;
        }else {
            $("#f_name").text("Father's name formate is invalid.")
            return false;
        }
    }

    $("#fname").keyup(function () {
        checkfname()
    });
    //  mother-name
    function checkmname(){
        var mname = $("#mname").val();
        var reg = /^[a-zA-Z -.]{3,55}$/;

        // var test =$("#mname").attr("type");

        if(reg.test(mname)){
            $("#m_name").text("")
            return true;
        }else {
            $("#m_name").text("Mother's name formate is invalid.")
            return false;
        }
    }

    $("#mname").keyup(function () {
        checkmname()
    });

    //  mobilee
    function mobile(){
        var mobile = $("#mobile").val();
        var reg = /(^([+]{1}[8]{2}|0088)?(01){1}[3-9]{1}\d{8})$/;

        // var test =$("#mobile").attr("type");

        if(reg.test(mobile)){
            $("#mobile_no").text("")
            return true;
        }else {
            $("#mobile_no").text("Mobile formate is invalid.")
            return false;
        }
    }

    $("#mobile").keyup(function () {
        mobile()
    });

     //  address
     function address(){
        var address = $("#address").val();
        var reg = /^[a-zA-Z0-9-\/] ?([a-zA-Z0-9-\/]|[a-zA-Z0-9-\/] )*[a-zA-Z0-9-\/]$/;

        // var test =$("#address").attr("type");

        if(reg.test(address)){
            $("#stu_address").text("")
            return true;
        }else {
            $("#stu_address").text("Address formate is invalid.")
            return false;
        }
    }

    $("#address").keyup(function () {
        address()
    });

     //  gender
     function gender(){
        var gender = $("#gender").val();

        var male = "Male";
        var female = "Female";

        if(gender==male || gender==female){
            $("#gender1").text("")
            return true;
        }else{
            $("#gender1").text("Please select the gender,")
            return false;
        }

    }

    $("#gender").change(function () {
        gender()
    });

    //  religion
    function religion(){
        var religion = $("#religion").val();

        var hindu = "hindu";
        var muslim = "muslim";
        var christen = "christen";

        if(religion==hindu || religion==muslim || religion==christen){
            $("#religion1").text("")
            return true;
        }else{
            $("#religion1").text("Please select the religion.")
            return false;
        }

    }

    $("#religion").change(function () {
        religion()
    });

    //  Date Of Birth
    function date(){
        var dob = $("#dob").val();
   
        var reg = /^((0[1-9])|([12][1-9])|(3[01]))\/((0[1-9])|(1[0-2]))\/((19[0-9]{2})|(2[0-9]{3}))$/;

        // var test =$("#dob").attr("type");

        if(reg.test(dob)){
            $("#stu_dob").text("")
            return true;
        }else {
            $("#stu_dob").text("Date formate is invalid.")
            return false;
        }
    }

    $("#dob").change(function () {
        date()
    });


     //  Join Date
     function join(){
        var join_date = $("#join_date").val();
        var reg = /^((0[1-9])|([12][1-9])|(3[01]))\/((0[1-9])|(1[0-2]))\/((19[0-9]{2})|(2[0-9]{3}))$/;

        if(reg.test(join_date)){
            $("#employee_join").text("")
            return true;
        }else {
            $("#employee_join").text("Join Date formate is invalid.")
            return false;
        }
    }

    $("#join_date").change(function () {
        join()
    });

  
     //  designation
     function designation(){
        var designation = $("#designation").val();
        var reg = /[0-9]|\./;

        // var test =$("#designation").attr("type");

        if(reg.test(designation)){
            $("#designation_id").text("")
            return true;
        }else {
            $("#designation_id").text("Designation formate is invalid.")
            return false;
        }
        
        
    }

    $("#designation").change(function () {
        designation()
    });

    //  salary
    function salary(){
        var employee_salary = $("#salary").val();
        var reg = /^[0-9]+$/;

        if(reg.test(employee_salary)){
            $("#employee_salary").text("")
            return true;
        }else {
            $("#employee_salary").text("Salary formate is invalid.")
            return false;
        }
    }

    $("#salary").keyup(function () {
        salary()
    });

 

    @if(@isset($editData)){
    
    }
    @else
    
    //  image
    function image1(){
    var img = $("#img").val();
    var reg = /([a-zA-Z0-9\s_\\.\-:])+(.png|.jpg|.jpeg)$/;

    // var test =$("#img").attr("type");

    if(reg.test(img)){
        $("#img_id").text("")
        return true;
    }else {
        $("#img_id").text("Image formate is invalid.")
        return false;
    }
    
    
    }

    $("#img").change(function () {
        image1()
    });

    @endif
   

    $("#myForm").submit(function () {
        if(checkfirstname() == true & checkfname() == true & checkmname() == true & mobile() == true & address() == true & gender() == true & religion() == true & date() == true & designation() == true & salary() & image1() == true){
            return true;
        }else {
            return false;
        }
    });



</script>     


{{-- date piker --}}
<script>
    $(function() {
      $('input[name="dob"]').daterangepicker({
        singleDatePicker: true,
        showDropdowns: true,
        minYear: 1901,
        locale: {
        format: 'MM/DD/YYYY'
        }, 
        maxYear: parseInt(moment().format('YYYY'),10)
      });
    });
</script>

<script>
    $(function() {
      $('input[name="join_date"]').daterangepicker({
        singleDatePicker: true,
        showDropdowns: true,
        minYear: 1901,
        locale: {
        format: 'MM/DD/YYYY'
        }, 
        maxYear: parseInt(moment().format('YYYY'),10)
      });
    });
</script>


{{-- image show --}}
<script type="text/javascript">

    function readURL(input){
        if(input.files && input.files[0]){
            var reader = new FileReader();
            reader.onload = function(e){
                $('#image')
                .attr('src',e.target.result)
                // .width(80)
                // .height(80);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>



@endsection