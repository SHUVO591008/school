
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
                                       Student Roll Generate
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
                                                <form id="myForm">

                                                        {{ csrf_field() }}
                                                    <div class="form-group col-md-4">
                                                        <label style="color: black">Class</label>
                                                        <select name="class_id" class="form-control" id="stu_class">
                                                            <option selected disabled>Select Class</option>
                                                            
                                                            @foreach ($class as $item)
                                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                            @endforeach
                                                        </select>
                                                       
                                                      
                                                    </div>

                                                    <div class="form-group col-md-4">
                                                        <label style="color: black">Year</label>
                                                        <select name="year_id" class="form-control" id="year">
                                                            <option selected disabled>Select Year</option>
                                                           
                                                            @foreach ($year as $item)
                                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                            @endforeach
                                                        </select>
                                                       
                                                       
                                                    </div>

                                                    <div style="padding-top: 26px" class="form-group col-md-4">
                                                        <a id="Search" class="btn btn-success" name="Search">Search</a>
                                                    </div>

                                                    <div style="display: none" class="row" id="roll-generate">
                                                        <div class="col-md-12">
                                                            <table class="table table-bordered table-striped table-inverse table-responsive">
                                                                <thead class="thead-inverse">
                                                                    <tr>
                                                                        <th>ID No</th>
                                                                        <th>Student Name</th>
                                                                        <th>Father's Name</th>
                                                                        <th>Gender</th>
                                                                        <th>Roll</th>
                                                                    </tr>
                                                                    </thead>
                                                                    <tbody id="roll-generate-tr">
                                                                    </tbody>
                                                            </table>
                                                        </div>
                                                    </div>

                                                    <div style="margin-top: 40px;" class="col-md-12 content-top-2">
                                                        <input id="submit" class="btn btn-primary" type="submit" value="Roll Generate"/>
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
                               


{{-- search --}}
<script type="text/javascript">
    $(document).on('click','#Search',function(){
      
        var class_id = $('#stu_class').val();
        var year_id = $('#year').val();

        $('.notifyjs-corner').html('');

        if(class_id==null){
            $.notify("Class is Required!", {globalPosition:'top right',className:'error'});
            return false;
        }
        if(year_id==null){
            $.notify("Year is Required!", {globalPosition:'top right',className:'error'});
            return false;
        }

        $.ajax({
            type:'GET',
            url:'{{route('getstudent.search')}}',
            data:{
                'class_id':class_id,
                'year_id':year_id,
                },
                error: function (data) {
                console.log(data);
               
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
               

                var html = '';
                $.each( data,function( key, v){
                    html +=
                    '<tr>'+
                    '<td>'+v.student_data.id_no+'<input type="hidden" name="student_id[]" value="'+v.student_id+'"></td>'+
                    '<td>'+v.student_data.name+'</td>'+
                    '<td>'+v.student_data.fname+'</td>'+
                    '<td>'+v.student_data.gender+'</td>'+
                    '<td><input id="roll" type="text" class="form-control" name="roll[]" value="'+v.roll+'"></td>'+
                    '</tr>';
                });

                html = $("#roll-generate-tr").html(html);
            },
            
        });  
    });
</script>


             
{{-- ajax validation --}}
<script type="text/javascript">
    $(document).ready(function() {
        $("#submit").click(function(e){
            e.preventDefault();

            var _token = $("input[name='_token']").val();
            var class_id = $('#stu_class').val();
            var year_id = $('#year').val();

            var roll = $("input[name='roll[]']").map(function(){ 
                    return this.value; 
                }).get();

            var student_id = $("input[name='student_id[]']").map(function(){ 
                return this.value; 
            }).get();

            if(student_id==''){
                $('#msg_div').fadeIn();
                $('#res_message').html('please search the students');
                return false;
                
            };

            $.ajax({
                url: "{{ route('rollgenerate.validate') }}",
                type:'POST',
                data: {
                _token:_token, 
                'roll[]':roll,
                'student_id[]':student_id,
                class_id:class_id,
                year_id:year_id,
                },
                success: function(data) {
                    if(data.error){
                        printErrorMsg(data.error);
                    }else{
                        window.location="{{ url('student/reg/view?success') }}";
                    }
 
                }
            });


        }); 


        function printErrorMsg (msg) {
            $(".print-error-msg").find("ul").html('');
            $(".print-error-msg").css('display','block');
            $.each( msg, function( key, value ) {
                $(".print-error-msg").find("ul").append('<li>'+value+'</li>');
            });

            return false;
        }
    });
</script>




@endsection