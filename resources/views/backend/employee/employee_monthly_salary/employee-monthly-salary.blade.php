
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
                                       Employee Monthly Salary
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

                                   

                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                               
                                                <div class="form-group col-md-4">
                                                    <label style="color: black">Date</label>
                                                    <input id="date" placeholder="" type="text" name="date" value="01/01/2016" class="form-control" autocomplete="off" readonly>
                                                    <span id="employee_att_date" style="color: red"></span>

                                                    @error('start_date')
                                                        <span style="color: red;font-size: 12px" class="invalid-feedback error" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                     @enderror
                                                </div>

                                                <div style="padding-top: 26px" class="form-group col-md-4">
                                                    <a id="Search" class="btn btn-success" name="Search">Search</a>
                                                </div>

                                            </div>
                                        </div> <!-- End Row panal -->
                                    </div>

                                    <div class="panel-body">
                                        <div class="row">
                                            <div id="documentResult"></div>
                                            
                                            <script id="document-template" type="text/x-handlebars-template">
                                                <div style="width: 100%;text-align: center">
                                                    <strong>
                                                        @{{{date}}}
                                                    </strong>
                                                </div>
                                                <br/>
                                                <br/>
                                                <br/>
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

{{-- search --}}
<script type="text/javascript">
    $(document).on('click','#Search',function(){
      
        var date = $('#date').val();
      
        if(date==null){
            $.notify("Date filed is Required!", {globalPosition:'top right',className:'error'});
            return false;
        }
        

        $.ajax({
            url:"{{ route('employe.monthly.salary.get') }}",
            type:"get",
            data:{'date':date},
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
</script>


@endsection