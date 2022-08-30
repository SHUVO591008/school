
@extends('layouts.app')


@section('web')

   

    {{-- date Picker --}}
    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

    {{-- Select 2 --}}
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>

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
                                           Manage Student Fee(Add/Edit)
                                        <a style="float: right" class="btn btn-success" href="{{ route('accounts.fee.grade.view') }}"> <i class="fa fa-list" aria-hidden="true"></i> Student Fee View </a>
                                       
                                        
                                    </div>

                                    <div class="alert alert-danger print-error-msg" style="display:none">
                                        <ul></ul>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                           <div style="display: none" class="alert alert-success" id="msg_div">
                                                   <span id="res_message"></span>
                                              </div>
                                        </div>
                                     </div>

                                    <div style="background: #fff" class="panel-body">
                                        <div class="row">
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                <div class="form-group col-md-3">
                                                    <label style="color: black" for="year_id">Year</label>
                                                    <select name="year_id" id="year_id" class="form-control select2">
                                                        <option selected disabled>Select Year</option>
                                                        @foreach ($year as $item)
                                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>


                                                <div class="form-group col-md-3">
                                                    <label style="color: black" for="class_id">Class</label>
                                                    <select name="class_id" id="class_id" class="form-control select2">
                                                        <option selected disabled>Select Class</option>
                                                        @foreach ($class as $item)
                                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>


                                                <div class="form-group col-md-3">
                                                    <label style="color: black" for="fee_category_id">Exam Type</label>
                                                    <select name="fee_category_id" id="fee_category_id" class="form-control select2">
                                                        <option selected disabled>Select Exam Type</option>
                                                        @foreach ($studentFeeCategory as $item)
                                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="form-group col-md-3">
                                                    <label style="color: black">Date</label>
                                                    <input id="date" placeholder="" type="text" name="date" value="01/01/2016" class="" autocomplete="off" readonly>

                                                    <span id="employee_att_date" style="color: red"></span>

                                                 
                                                </div>

                                                <div class="col-md-12">
                                                    <input id="search" type="submit" class="btn btn-success" value="Search">
                                                </div>

                                            </div>
                                        </div> <!-- End Row panal -->
                                    </div>


                                    <div class="panel-body">
                                        <div class="row">
                                            <div id="documentResult">

                                            
                                            </div>
                                        
                                            <script id="document-template" type="text/x-handlebars-template">
                                                <form action="{{ route('accounts.fee.grade.store') }}" method="post">
                                                    @csrf                                   
                                                <table class="table table-striped table-inverse table-responsive" style="width: 100%">
                                                    <thead>
                                                        <tr>
                                                          @{{{thsource}}}
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                            @{{#each this}}
                                                            <tr>
                                                                @{{{tdsource}}}
                                                            </tr>
                                                            @{{/each}}
                                                            
                                                        </tbody>
                                                       
                                                </table>

                                                @{{{btn}}}
                                               
                                            
                                            </form>

                                            </script>
                                        
                                           
                                        </div>
                                    </div>




                                </div> <!-- panel -->
                            </div> <!-- col-12 -->
                            
                        </div> <!-- End Row -->


                    </div> <!-- container -->
                    
                </div><!-- content -->
            </div><!-- content-page -->

{{-- Select 2 --}}
<script>
    $(".select2").select2({
        tags: true
    });
</script>

{{-- validation --}}
<script>

    //store validation
    $(document).on('click','#search',function(){

    var year_id = $("#year_id").val();
    var class_id = $("#class_id").val();
    var fee_category_id = $("#fee_category_id").val();
    var date = $("#date").val();


    if(year_id==null){
        $.notify("please select the year", {globalPosition:'top right',className:'error'});
        return false;
    }

    if(class_id==null){
        $.notify("please select the class", {globalPosition:'top right',className:'error'});
        return false;
    }

    if(fee_category_id==null){
        $.notify("please select the fee type", {globalPosition:'top right',className:'error'});
        return false;
    }

    if(date==null){
        $.notify("please select the date", {globalPosition:'top right',className:'error'});
        return false;
    }


    $.ajax({
        url:"{{ route('accounts.fee.get-student') }}",
        type:"get",
        data:{'year_id':year_id,'class_id':class_id,'fee_category_id':fee_category_id,'date':date},
        beforeSend:function(){

        },
        success:function(data){
            if(data.msg){
                $('#msg_div').fadeIn();
                $('#res_message').html(data.msg);
                $('#roll-generate').fadeOut();
          
               
            }else{
                $('#roll-generate').fadeIn();

                $('#msg_div').fadeOut();
               
            }

            var source = $('#document-template').html();
            var template = Handlebars.compile(source);
            var html = template(data);
            $("#documentResult").html(html);
            $('[data-toggle="tooltip"]').tooltip();
        }
    });

   
    });

   

//store validation End
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