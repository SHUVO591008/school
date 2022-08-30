

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
                                            Edit Employee Leave
                                        @else
                                            Add Employee Leave
                                        @endif

                                        <a style="float: right" class="btn btn-success" href="{{ route('employe.leave.view') }}"> <i class="fa fa-list" aria-hidden="true"></i> Employee Leave List </a>

                                        
                                    </div>

                                    <div style="background: #fff" class="panel-body">
                                        <div class="row">
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                <form method="post" id="myForm" action="@if(@isset($editData)){{ route('employe.leave.update',$editData->id) }}@else{{ route('employe.leave.store') }}@endif" enctype="multipart/form-data">
                                                    @csrf
                                                    <div style="height: 100px" class="form-row">

                                                        <div class="form-group col-md-4">
                                                            <label style="color: black">Employee Name</label>
                                                           <select name="employee_id" class="form-control" id="employee">
                                                                <option selected disabled>Select Name</option>
                                                                @foreach ($employee as $item)
                                                                <option @if(@isset($editData)){{ ($editData->employee_id ==$item->id )?"selected":"" }}@endif value="{{ $item->id }}">{{ $item->name }}</option>
                                                                @endforeach
                                                            </select>
                                                            <span id="employeeName" style="color: red"></span>

                                                            @error('employee_id')
                                                                <span style="color: red;font-size: 12px" class="invalid-feedback error" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                             @enderror
                                                        </div>

                                                        <div class="form-group col-md-4">
                                                            <label style="color: black">Start Date</label>
                                                            <input id="start" placeholder="" type="text" name="start_date" value="@if(@isset($editData)){{ date('m-d-Y',strtotime($editData->start_date)) }}@else 01/01/2016 @endif" class="form-control" autocomplete="off" readonly>
                                                            <span id="employee_start_date" style="color: red"></span>

                                                            @error('start_date')
                                                                <span style="color: red;font-size: 12px" class="invalid-feedback error" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                             @enderror
                                                        </div>

                                                      

                                                        <div class="form-group col-md-4">
                                                            <label style="color: black">End Date</label>
                                                            <input id="end" placeholder="" type="text" name="end_date" value="@if(@isset($editData)){{ date('m-d-Y',strtotime($editData->end_date)) }}@else 01/01/1998 @endif" class="form-control" autocomplete="off" readonly>
                                                            <span id="employee_end_date" style="color: red"></span>

                                                            @error('end_date')
                                                                <span style="color: red;font-size: 12px" class="invalid-feedback error" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                             @enderror
                                                        </div>

                                                    </div> 

                                                    <div style="height: 100px" class="from-row">
                                                        <div class="form-group col-md-4">
                                                            <label style="color: black">Leave Purpose</label>
                                                           <select name="leave_purpose_id" class="form-control" id="leave">
                                                                <option selected disabled>Select Purpose</option>
                                                                @foreach ($leavePurpose as $item)
                                                                <option @if(@isset($editData)){{ ($editData->leave_purpose_id ==$item->id )?"selected":"" }}@endif value="{{ $item->id }}">{{ $item->name }}</option>
                                                                @endforeach
                                                                <option value="0">New Purpose</option>
                                                            </select>

                                                            <input style="margin-top:16px;display: none" placeholder="Write Purpose" name="name" class="form-control" type="text" id="new_purpose">

                                                            <span id="leave_purpose" style="color: red"></span>

                                                            @error('leave_purpose_id')
                                                                <span style="color: red;font-size: 12px" class="invalid-feedback error" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                             @enderror

                                                             @error('name')
                                                                <span style="color: red;font-size: 12px" class="invalid-feedback error" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                             @enderror
                                                        </div> 
                                                    </div>

                                                        

                                                    <div class="form-group col-md-12">
                                                        <input class="btn btn-primary" type="submit" value="@if(@isset($editData)) Leave Update @else Leave @endif">
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
        var employee = $("#employee").val();

        if(employee==null){
            $("#employeeName").text("Employee Name formate is invalid.")
            return false;
        }else{
            $("#employeeName").text("")
            return true;
        }

    }

    $("#employee").change(function () {
            checkfirstname()
    });


    //  Start Date
    function startdate(){
        var start_date = $("#start").val();
        var reg = /^((0[1-9])|([12][1-9])|(3[01]))\/((0[1-9])|(1[0-2]))\/((19[0-9]{2})|(2[0-9]{3}))$/;

        if(reg.test(start_date)){
            $("#employee_start_date").text("")
            return true;
        }else{
            $("#employee_start_date").text("Date formate is invalid.")
            return false;
        }
    }

    $("#start").change(function () {
        startdate()
    });

    //  End Date
    function enddate(){
        var end_date = $("#end").val();
        var reg = /^((0[1-9])|([12][1-9])|(3[01]))\/((0[1-9])|(1[0-2]))\/((19[0-9]{2})|(2[0-9]{3}))$/;

        if(reg.test(end_date)){
            $("#employee_end_date").text("")
            return true;
        }else {
            $("#employee_end_date").text("End Date formate is invalid.")
            return false;
        }
    }

    $("#end").change(function () {
        enddate()
    });



     //  leave purpose
     function leave(){

        var leave1 = $("#leave").val();
        var leavename = $("#new_purpose").val();
        var reg = /^[a-zA-Z -.]{3,55}$/;
        if(leave1==null){
            $("#leave_purpose").text("Leave Name formate is invalid.");
            return false;
        }else if(leave1==0){
            $('#new_purpose').show();
                if(leavename==null){
                    $("#leave_purpose").text("New Purpose Name formate is invalid.")
                    return false;
                }else{
                    if(reg.test(leavename)){
                        $("#leave_purpose").text("")
                        return true;
                    }else{
                        $("#leave_purpose").text("New Purpose Name formate is invalid.")
                        return false;
                    }
                }
        }else{
            $('#new_purpose').hide();
            $("#leave_purpose").text("")
            return true;
        }
       
    }



    $("#leave").change(function () {
        leave();
    });




    $("#myForm").submit(function () {
        if(checkfirstname() == true & startdate() == true & enddate() == true & leave() == true){
            return true;
        }else {
            return false;
        }
    });



</script> 


{{-- date piker --}}
<script>
    $(function() {
      $('input[name="start_date"]').daterangepicker({
        singleDatePicker: true,
        showDropdowns: true,
        minYear: 1900,
        locale: {
          format: 'MM/DD/YYYY'
        }, 
        maxYear: parseInt(moment().format('YYYY'),10)
      });
    });
</script>

<script>
    $(function() {
      $('input[name="end_date"]').daterangepicker({
        singleDatePicker: true,
        showDropdowns: true,
        minYear: 1900,
        locale: {
          format: 'MM/DD/YYYY'
        }, 
        maxYear: parseInt(moment().format('YYYY'),10)
      });
    });
</script>





@endsection