
@extends('layouts.app')


@section('web')

<style>
    a.nav-link {
    font-size: 12px;
    font-weight: 600;
    padding: 0.75rem 1rem 1rem;
    text-decoration: none;
    text-transform: uppercase;
    }
    
    .active {
        border-bottom: 3px solid burlywood;
    }

</style>

 {{-- date Picker --}}
 <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
 <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
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
                                        <h3>Manage Monthly/Yearly Profit</h3>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                           <div style="display: none" class="alert alert-success" id="msg_div">
                                                   <span id="res_message"></span>
                                              </div>
                                        </div>
                                     </div>

                                     

                                    <?php

                                    $date = Carbon\Carbon::now();
                                    $dateS = $date->day;
                                    $month = $date->month;
                                    $year = $date->year;
                                   
                                    ?>

                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="form-group col-md-4">
                                                <input id="start_date" placeholder="Start Date" type="text" name="start_date" value="{{ $dateS }}-{{ $month }}-{{ $year }}" class="form-control" autocomplete="off" readonly>

                                                <span id="strdateerror" style="color: red"></span>
                                                @error('start_date')
                                                    <span style="color: red;font-size: 12px" class="invalid-feedback error" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-group col-md-4">
                                                <input id="end_date" placeholder="End Date" type="text" name="end_date" value="{{ $dateS }}-{{ $month }}-{{ $year }}" class="form-control" autocomplete="off" readonly>

                                                <span id="enddateerror" style="color: red"></span>
                                                @error('end_date')
                                                    <span style="color: red;font-size: 12px" class="invalid-feedback error" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                       

                                            <div class="col-md-4">
                                                <button class="btn btn-success" type="submit" id="search"><i class="fa fa-search" aria-hidden="true"></i> Search</button>
                                     
                                            </div>
                                            
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="panel-body">
                                        <div class="row">
                                            <div id="documentResult"></div>
                                            
                                            <script id="document-template" type="text/x-handlebars-template">
                                                <div style="width: 100%;text-align: center">
                                                    <strong>
                                                        @{{{date}}}
                                                    </strong>
                                                    <hr>
                                                </div>
                                                <br/>
                                               
                                                <table id="datatable" class="table table-striped table-bordered text-center" style="width: 100%">
                                                    <thead>
                                                        <tr>
                                                          @{{{thsource}}}
                                                          
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                            
                                                           
                                                            
                                                            <tr style="border: 1px solid #e4e4e4">
                                                                @{{{tdsource}}}
                                                            </tr>
                                                         
                                                        </tbody>

                                                       
                                                </table>
                                            </script>
                                        </div>
                                    </div>
                                </div> <!-- panel -->
                            </div> <!-- col-12 -->
                            
                        </div> <!-- End Row -->


                    </div> <!-- container -->
                    
                </div><!-- content -->
            </div><!-- content-page -->

         


{{-- date piker --}}
<script>
    $(function(){
        $("input[name='start_date']").datepicker({
            dateFormat: "dd-mm-yy",
            changeMonth: true,
            changeYear: true
        });
    });
</script>
<script>
    $(function(){
        $("input[name='end_date']").datepicker({
            dateFormat: "dd-mm-yy",
            changeMonth: true,
            changeYear: true
        });
    });
</script>


{{-- validation --}} {{-- search --}}
<script>
    function startdate(){
            var datevali = $("#start_date").val();
            var reg = /^(0?[1-9]|[12][0-9]|3[01])[\/\-](0?[1-9]|1[012])[\/\-]\d{4}$/;
            
            var test =$("#start_date").attr("type");

            if(reg.test(datevali)){
                $("#strdateerror").text("")
                return true;
            }else {
                $("#strdateerror").text("Start Date formate is invalid.")
                return false;
            }
    }

    $("#start_date").change(function () {
        startdate();
    });

    function enddate(){
            var datevali = $("#end_date").val();
            var reg = /^(0?[1-9]|[12][0-9]|3[01])[\/\-](0?[1-9]|1[012])[\/\-]\d{4}$/;
            
            var test =$("#end_date").attr("type");

            if(reg.test(datevali)){
                $("#enddateerror").text("")
                return true;
            }else {
                $("#enddateerror").text("End Date formate is invalid.")
                return false;
            }
    }
    $("#end_date").change(function () {
        enddate();
    });



    $('#search').click(function(){

        if(startdate() == true & enddate() == true){

        var star_date = $('#start_date').val();
        var end_date = $('#end_date').val();


        $.ajax({
            type: "get",
            url: "{{ route('report.profit') }}",
            data:{
                'star_date':star_date,
                'end_date':end_date,
                },
            success:function (response) {

                if(response.msg){
                    $('#msg_div').fadeIn();
                    $('#res_message').html(response.msg);
                    // $('#roll-generate').fadeOut();
                }else{
                    $('#msg_div').fadeOut();
                }

                var source = $('#document-template').html();
                var template = Handlebars.compile(source);
                var html = template(response);
                $("#documentResult").html(html);
                $('[data-toggle="tooltip"]').tooltip();

                    
                
            }
        


            
        });


            
        }else {
            return false;
        }


        

    });

</script>  







@endsection