
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
                                       Student Marks Edit
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
                                                        <label style="color: black">Year</label>
                                                        <select name="year_id" class="form-control" id="year">
                                                            <option selected disabled>Select Year</option>
                                                           
                                                            @foreach ($year as $item)
                                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                            @endforeach
                                                        </select>
                                                                                                               
                                                    </div>


                                                    <div class="form-group col-md-3">
                                                        <label style="color: black">Subject</label>
                                                        <select name="assign_subject_id" class="form-control" id="assign_subject_id">
                                                            <option selected disabled>Select subject</option>
                                                           
                                                        </select>
                                                    </div>

                                                    <div class="form-group col-md-3">
                                                        <label style="color: black">Exam Type</label>
                                                        <select name="exam_type_id" class="form-control" id="exam_type">
                                                            <option selected disabled>Select Exam Type</option>
                                                           
                                                            @foreach ($exam_type as $item)
                                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                            @endforeach
                                                        </select>
                                                                                                               
                                                    </div>


                                                    <div style="padding-top: 26px" class="form-group col-md-3">
                                                        <a id="Search" class="btn btn-success" name="Search">Search</a>
                                                    </div>

                                                   


                                                    <div style="display: none" class="row" id="marks-generate">
                                                        <div class="col-md-12">
                                                            <table class="table table-bordered table-striped table-inverse table-responsive">
                                                                <thead class="thead-inverse">
                                                                    <tr>
                                                                        <th>ID No</th>
                                                                        <th>Student Name</th>
                                                                        <th>Father's Name</th>
                                                                        <th>Gender</th>
                                                                        <th>Marks</th>
                                                                    </tr>
                                                                    </thead>
                                                                    <tbody id="marks_entry_tr">
                                                                    </tbody>
                                                            </table>
                                                        </div>

                                                        <div style="margin-top: 40px; margin-left: 55px;" class="col-md-12 content-top-2">
                                                            <input id="submit" class="btn btn-primary" type="submit" value="Marks Update"/>
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

        

{{-- ajax subject show--}}
<script type="text/javascript">

    $(function(){
        $(document).on('change','#stu_class',function(){
            var class_id = $('#stu_class').val();
            $.ajax({
                url:"{{route('marks-getSubject')}}",
                type:"GET",
                data:{class_id:class_id},
                success:function(data){
                        var html = '<option selected disabled>Select subject</option>';
                    $.each(data,function(key,v){
                        html +='<option value="'+v.id+'">'+v.subject.name+'</option>';
                    });
                    $('#assign_subject_id').html(html);
                }
            });

        });
    });
</script>

{{-- search --}}
<script type="text/javascript">
    $(document).on('click','#Search',function(){
      
        var class_id = $('#stu_class').val();
        var year_id = $('#year').val();
        var assign_subject_id = $('#assign_subject_id').val();
        var exam_type = $('#exam_type').val();

        $('.notifyjs-corner').html('');

        if(class_id==null){
            $.notify("Class field is required!", {globalPosition:'top right',className:'error'});
            return false;
        }
        if(year_id==null){
            $.notify("Year field is required!", {globalPosition:'top right',className:'error'});
            return false;
        }
        if(assign_subject_id==null){
            $.notify("Subject field is required!", {globalPosition:'top right',className:'error'});
            return false;
        }

        if(exam_type==null){
            $.notify("Exam type field is required!", {globalPosition:'top right',className:'error'});
            return false;
        }

        $.ajax({
            type:'GET',
            url:'{{route('get-student-marks')}}',
            data:{
                'class_id':class_id,
                'year_id':year_id,
                'assign_subject_id':assign_subject_id,
                'exam_type':exam_type,
                },
                error: function (data) {
                console.log(data);
               
            },
            success:function(data){
               
                if(data.msg){
                    $('#msg_div').fadeIn();
                    $('#res_message').html(data.msg);
                    $('#marks-generate').fadeOut();
                }else{
                    $('#marks-generate').fadeIn();
                    $('#msg_div').fadeOut();
                }
               

                var html = '';
                $.each(data,function( key, v){
                    html +=
                    '<tr>'+
                    '<td>'+v.student_data.id_no+'<input type="hidden" name="student_id[]" value="'+v.student_id+'"></td>'+
                    '<td>'+v.student_data.name+'</td>'+
                    '<td>'+v.student_data.fname+'</td>'+
                    '<td>'+v.student_data.gender+'</td>'+
                    '<td><input type="text" class="form-control" id="marks'+key+'" name="marks[]" value="'+v.marks+'"></td>'+
                    '</tr>';
                });

                html = $("#marks_entry_tr").html(html);
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
            var subject_id = $('#assign_subject_id').val();
            var exam_type_id = $('#exam_type').val();

            var marks = $("input[name='marks[]']").map(function(){ 
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
                url: "{{ route('student.marks.update') }}",
                type:'POST',
                data: {
                _token:_token, 
                'marks[]':marks,
                'student_id[]':student_id,
                class_id:class_id,
                year_id:year_id,
                subject_id:subject_id,
                exam_type_id:exam_type_id,
                },
                success: function(data) {
                    if(data.wrong){
                        $('#msg_div').fadeIn();
                        $('#res_message').html(data.wrong);
                        $('#marks-generate').fadeOut();
                    };
                  
                    if(data.error){
                        $('#msg_div').fadeIn();
                        $('#res_message').html(data.error);
                        // $('#marks-generate').fadeOut();
                    }else if(data.datacheck){
                        $('#msg_div').fadeIn();
                        $('#res_message').html(data.datacheck);
                        // $('#marks-generate').fadeOut();
                    }else if(data.marksgeter){
                        $('#msg_div').fadeIn();
                        $('#res_message').html(data.marksgeter);
                        // $('#marks-generate').fadeOut();
                    }else{
                        var html = 'Marks Update Succesfully.';
                        $('#msg_div').fadeIn();
                        $('#res_message').html(html);
                        $('#marks-generate').fadeOut();
                        // window.location="{{ url('student.marks.add?success') }}";
                    }
 
                }
            });


        }); 


        // function printErrorMsg (msg) {
        //     $(".print-error-msg").find("ul").html('');
        //     $(".print-error-msg").css('display','block');
        //     // $.each( msg, function( key, value ) {
        //     //     $(".print-error-msg").find("ul").append('<li>'+value+'</li>');
        //     // });

        //     return false;
        // }
    });
</script>




@endsection