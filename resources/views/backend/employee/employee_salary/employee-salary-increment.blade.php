

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
                                            Employee Salary Increment                                       
                                        <a style="float: right" class="btn btn-success" href="{{ route('employe.salary.view') }}"> <i class="fa fa-list" aria-hidden="true"></i> Employee Salary List</a>
                                       
                                    </div>

                                    <div style="background: #fff" class="panel-body">
                                        <h4 class="text-center">Employee Information
                                            <hr>
                                        </h4>
                                        <h5 style="padding: 5px">Name : {{ $allData->name }}</h5>
                                        <h5 style="padding: 5px">ID No : {{ $allData->id_no }}</h5>
                                        <h5 style="padding: 5px">Designation : {{ $allData['designation']['name'] }}</h5>
                                        <h5 style="padding: 5px">Previous salary : {{number_format($allData->salary, 0, '.', ',') }}</h5>
                                        <h5 style="padding: 5px">Join Date : {{ date('d-M-Y',strtotime($allData->join_date)) }}</h5>
                                        <hr>
                                        <div class="row">
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                <form method="post" id="myForm" action="{{ route('employe.salary.increment.store',$allData->id) }}">
                            
                                                    @csrf
                                                    <div class="form-row">
                                                       
                                                        <div class="form-group col-md-4">
                                                            <label style="color: black">Increment Salary</label>
                                                            <input id="amount" placeholder="Amount" type="text" name="incriment_salary" value="{{ old('incriment_salary') }}" class="form-control" autocomplete="off" >
                                                            <span id="AmountError" style="color: red"></span>

                                                            @error('incriment_salary')
                                                                <span style="color: red;font-size: 12px" class="invalid-feedback error" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                             @enderror
                                                        </div>

                                                        <div class="form-group col-md-4">
                                                            <label style="color: black">Effected Date</label>
                                                            <input id="effected_date" type="text" name="effected_date" value=" 01/01/1998" class="form-control" autocomplete="off" readonly>
                                                            <span id="effected_dateError" style="color: red"></span>

                                                            @error('effected_date')
                                                                <span style="color: red;font-size: 12px" class="invalid-feedback error" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                             @enderror
                                                        </div>


                                                        <div class="form-group col-md-12">
                                                            <input class="btn btn-primary" type="submit" value="Save">
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

    //  effected Date
    function date(){
        var effected_date = $("#effected_date").val();
   
        var reg = /^((0[1-9])|([12][1-9])|(3[01]))\/((0[1-9])|(1[0-2]))\/((19[0-9]{2})|(2[0-9]{3}))$/;

        // var test =$("#effected_date").attr("type");

        if(reg.test(effected_date)){
            $("#effected_dateError").text("")
            return true;
        }else {
            $("#effected_dateError").text("Date formate is invalid.")
            return false;
        }
    }
    $("#effected_date").change(function () {
        date()
    });


    //  salary
    function amount(){
        var incriment_salary = $("#amount").val();
        var reg = /^[0-9]+$/;

        if(reg.test(incriment_salary)){
            $("#AmountError").text("")
            return true;
        }else {
            $("#AmountError").text("Incriment salary formate is invalid.")
            return false;
        }
    }
    $("#amount").keyup(function () {
        amount();
    });

    $("#myForm").submit(function () {
        if(date() == true & amount() == true ){
            return true;
        }else {
            return false;
        }
    });

</script>     


{{-- date piker --}}
<script>
    $(function() {
      $('input[name="effected_date"]').daterangepicker({
        singleDatePicker: true,
        showDropdowns: true,
        minYear: 1901,
        locale: {
          format: 'DD/MM/YYYY'
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
          format: 'DD/MM/YYYY'
        }, 
        maxYear: parseInt(moment().format('YYYY'),10)
      });
    });
</script>






@endsection