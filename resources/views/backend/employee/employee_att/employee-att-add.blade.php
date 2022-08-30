

@extends('layouts.app')


@section('web')

{{-- date Picker --}}
<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />


<style>

    .switch-field {
	display: flex;
	overflow: hidden;
}

.switch-field input {
	position: absolute !important;
	clip: rect(0, 0, 0, 0);
	height: 1px;
	width: 1px;
	border: 0;
	overflow: hidden;
}

.switch-field label {
	background-color: #e4e4e4;
	color: rgba(0, 0, 0, 0.6);
	font-size: 14px;
	line-height: 1;
	text-align: center;
	padding: 8px 16px;
	margin-right: -1px;
	border: 1px solid rgba(0, 0, 0, 0.2);
	box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.3), 0 1px rgba(255, 255, 255, 0.1);
	transition: all 0.1s ease-in-out;
}

.switch-field label:hover {
	cursor: pointer;
}

.switch-field input:checked + label {
	background-color: #a5dc86;
	box-shadow: none;
}

.switch-field label:first-of-type {
	border-radius: 4px 0 0 4px;
}

.switch-field label:last-of-type {
	border-radius: 0 4px 4px 0;
}


</style>


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
                                            Edit Employee Attendence
                                        @else
                                            Take Employee Attendence
                                        @endif

                                        <a style="float: right" class="btn btn-success" href="{{ route('employe.attendences.view') }}"> <i class="fa fa-list" aria-hidden="true"></i> Employee Attendence List </a>

                                        
                                    </div>

                                    <div style="background: #fff" class="panel-body">
                                        <div class="row">
                                            <div class="col-md-12 col-sm-12 col-xs-12">  

                                                
                                         

                                                <form method="post" id="myForm" action="{{route('employe.attendences.store')}}" enctype="multipart/form-data">
                                                    @csrf

                                                    <div class="form-group col-md-4">
                                                        <label style="color: black">Date</label>
                                                        <input id="date" placeholder="" type="text" name="date" value="@if(@isset($editData)){{ date('m-d-Y',strtotime($editData[0]['date'])) }}@else 01/01/2016 @endif" class="form-control" autocomplete="off" readonly>
                                                        <span id="employee_att_date" style="color: red"></span>

                                                        @error('start_date')
                                                            <span style="color: red;font-size: 12px" class="invalid-feedback error" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                         @enderror
                                                    </div>


                                                    <table border="1" class="table table-striped table-inverse table-responsive">
                                                        <thead class="thead-inverse">
                                                            <tr>
                                                                <th rowspan="2" class="text-center" style="vertical-align: middle">SL</th>
                                                                <th rowspan="2" class="text-center" style="vertical-align: middle">Employee Name</th>
                                                                <th width="20%" colspan="3" class="text-center" style="vertical-align: middle">Attendence Status</th>
                                                            </tr>
                                                            <tr>
                                                                <th class="text-center btn present_all datetime" style="display: table-cell;background-color: #1b52b5e8;color:white;border:1px solid yellow">Present</th>
                                                                <th class="text-center btn leave_all datetime" style="display: table-cell;background-color: #1b52b5e8;color:white;border:1px solid yellow">Leave</th>
                                                                <th class="text-center btn absent_all datetime" style="display: table-cell;background-color: #1b52b5e8;color:white;border:1px solid yellow">Absent</th>
                                                            </tr>

                                                            </thead>
                                                            <tbody>

                                                            @if(@isset($editData))
                                                                @foreach ($editData as $key => $item)
                                                                <tr id="div{{$item->id}}" class="text-center">
                                                                <input type="hidden" name="employee_id[]" value="{{ $item->employee_id }}" class="employee_id">
                                                                    <td>{{ $key+1 }}</td>
                                                                    <td>{{ $item['user']['name'] }}</td>
                                                                    <td colspan="3">

                                                                        <div class="switch-field">
                                                                            <input  class="present" id="present{{$key}}" name="att_status{{$key}}" value="Present" type="radio" {{ ($item->att_stutas=='Present')?'checked':''}}>
                                                                            <label for="present{{$key}}">Present</label>

                                                                            <input class="leave" id="leave{{$key}}" name="att_status{{$key}}" value="Leave" type="radio" {{ ($item->att_stutas=='Leave')?'checked':''}}>
                                                                            <label for="leave{{$key}}">Leave</label>

                                                                            <input class="absent" id="absent{{$key}}" name="att_status{{$key}}" value="Absent" type="radio"
                                                                            {{ ($item->att_stutas=='Absent')?'checked':''}}>
                                                                            <label for="absent{{$key}}">Absent</label>

                                                                            <?php

                                                                            $test = $key;
                                                                            
                                                                            $final = 'att_status'.$test;
            
                                                                                                        
                                                                            ?>
                                                                        </div>
                                                                        @error($final)
                                                                        <div>
                                                                            <span style="color: red;font-size: 12px" class="invalid-feedback error" role="alert">
                                                                                <strong>{{ $message }}</strong>
                                                                            </span>
                                                                        </div>
                                                                    @enderror
                                                                    </td>
                                                                </tr>
                                                                @endforeach
                                                            @else
                                                                @foreach ($employee as $key => $item)
                                                                <tr id="div{{$item->id}}" class="text-center">
                                                                <input type="hidden" name="employee_id[]" value="{{ $item->id }}" class="employee_id">
                                                                    <td>{{ $key+1 }}</td>
                                                                    <td>{{ $item->name }}</td>
                                                                    <td colspan="3">

                                                                        <div class="switch-field">
                                                                            <input  class="present" id="present{{$key}}" name="att_status{{$key}}" value="Present" type="radio" checked="checked">
                                                                            <label for="present{{$key}}">Present</label>

                                                                            <input class="leave" id="leave{{$key}}" name="att_status{{$key}}" value="Leave" type="radio">
                                                                            <label for="leave{{$key}}">Leave</label>

                                                                            <input class="absent" id="absent{{$key}}" name="att_status{{$key}}" value="Absent" type="radio">
                                                                            <label for="absent{{$key}}">Absent</label>

                                                                            <?php

                                                                            $test = $key;
                                                                            
                                                                            $final = 'att_status'.$test;
            
                                                                                                        
                                                                            ?>
                                                                        </div>
                                                                        @error($final)
                                                                        <div>
                                                                            <span style="color: red;font-size: 12px" class="invalid-feedback error" role="alert">
                                                                                <strong>{{ $message }}</strong>
                                                                            </span>
                                                                        </div>
                                                                    @enderror
                                                                    </td>
                                                                </tr>
                                                                @endforeach
                                                            @endif

                                                           
                                                                
                                                            </tbody>
                                                    </table>
                                                   

                                                        <br/>
                                                        <br/>
                                                        <br/>

                                                    <div class="form-group col-md-12">
                                                        <input class="btn btn-primary" type="submit" value="@if(@isset($editData)) Attendence Update @else Take Attendence @endif">
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

<script>
    $(document).on('click','.present',function(){
        $(this).parents('tr').find('.datetime').css('pointer-event','none').css('background-color','#98a1e9').css('color','white');
    })
    $(document).on('click','.leave',function(){
        $(this).parents('tr').find('.datetime').css('pointer-event','').css('background-color','#013579d1').css('color','white');
    })
    $(document).on('click','.absent',function(){
        $(this).parents('tr').find('.datetime').css('pointer-event','none').css('background-color','#98a1e9').css('color','black');
    })
</script>

<script>
    $(document).on('click','.present_all',function(){
        $("input[value=Present]").prop('checked',true);
        $('.datetime').css('pointer-event','none').css('pointer-event','none').css('background-color','#98a1e9').css('color','white');
    })

    $(document).on('click','.leave_all',function(){
        $("input[value=Leave]").prop('checked',true);
        $('.datetime').css('pointer-event','').css('pointer-event','').css('background-color','#013579d1').css('color','white');
    })

    $(document).on('click','.absent_all',function(){
        $("input[value=Absent]").prop('checked',true);
        $('.datetime').css('pointer-event','none').css('pointer-event','none').css('background-color','#98a1e9').css('color','black');
    })

</script>

{{-- validation --}}
<script>



    //  Date
    // function attdate(){
    //     var date1 = $("#date").val();
    //     var reg = /^((0[1-11])|([12][1-9])|(3[01]))\/((0[1-9])|(1[0-2]))\/((19[0-9]{2})|(2[0-9]{3}))$/;

    //     if(reg.test(date1)){
    //         $("#employee_att_date").text("")
    //         return true;
    //     }else{
    //         $("#employee_att_date").text("Date formate is invalid.")
    //         return false;
    //     }
    // }

    // $("#date").change(function () {
    //     attdate()
    // });




    $("#myForm").submit(function () {
        if(attdate() == true){
            return true;
        }else {
            return false;
        }
    });



</script> 


{{-- date piker --}}
<script>
    $(function() {
      $('input[name="date"]').daterangepicker({
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