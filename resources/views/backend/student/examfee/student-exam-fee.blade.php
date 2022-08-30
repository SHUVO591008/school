
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
                                       Student Exam Fee
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
                                               
                                                    <div class="form-group col-md-3">
                                                        <label style="color: black">Class</label>
                                                        <select name="class_id" class="form-control" id="stu_class">
                                                            <option selected disabled>Select Class</option>
                                                            
                                                            @foreach ($class as $item)
                                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                            @endforeach
                                                        </select>
                                                       
                                                      
                                                    </div>

                                                    <div class="form-group col-md-3">
                                                        <label style="color: black">Exam Type</label>
                                                        <select name="exam_type_id" class="form-control" id="exam_type_id">
                                                            <option selected disabled>Select Exam Type</option>
                                                            @foreach ($examType as $item)
                                                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                    <div class="form-group col-md-3">
                                                        <label style="color: black">Year</label>
                                                        <select name="year_id" class="form-control" id="year">
                                                            <option selected disabled>Select Year</option>
                                                            @foreach ($year as $item)
                                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                    <div style="padding-top: 26px" class="form-group col-md-3">
                                                        <a id="Search" class="btn btn-success" name="Search">Search</a>
                                                    </div>

                                                  

                                               

                                            </div>
                                        </div> <!-- End Row panal -->
                                    </div>

                                    <div class="panel-body">
                                        <div class="row">
                                            <div id="documentResult"></div>
                                            <script id="document-template" type="text/x-handlebars-template">
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
                               


{{-- search --}}
<script type="text/javascript">
    $(document).on('click','#Search',function(){
      
        var class_id = $('#stu_class').val();
        var year_id = $('#year').val();
        var exam_type_id = $('#exam_type_id').val();

        $('.notifyjs-corner').html('');

        if(class_id==null){
            $.notify("Class is Required!", {globalPosition:'top right',className:'error'});
            return false;
        }
        if(year_id==null){
            $.notify("Year is Required!", {globalPosition:'top right',className:'error'});
            return false;
        }
        if(exam_type_id==null){
            $.notify("Exam type is Required!", {globalPosition:'top right',className:'error'});
            return false;
        }

        $.ajax({
            url:"{{ route('exam.getStudent') }}",
            type:"get",
            data:{'year_id':year_id,'class_id':class_id,'exam_type_id':exam_type_id},
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