
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
                                            Add Assign Subject
                                        <a style="float: right" class="btn btn-success" href="{{ route('students.assign.subject.view') }}"> <i class="fa fa-list" aria-hidden="true"></i> Student Fee Amount List </a>
                                       
                                        
                                    </div>

                                    <div style="background: #fff" class="panel-body">
                                        <div class="row">
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                        <form method="post" id="myForm" action="{{ route('students.assign.subject.store') }}">

                                                    {{ csrf_field() }}
                                                    <div class="add_item">
                                                        <div class="form-group row">
                                                            <div class="col-md-5">
                                                                <label style="color: black">Class</label>
                                                                <select id="class_id" name="class_id" class="form-control" >
                                                                    <option value="">Select class</option>
                                                                    @foreach ($class as $item)
                                                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                                    @endforeach
                                                                </select>
                                                              

                                                                @error('class_id')
                                                                    <span style="color: red;font-size: 12px" class="invalid-feedback error" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror

                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            <div class="col-md-4" style="padding-top: 20px">
                                                                <label style="color: black">Subject</label>
                                                                <select id="subject_id" name="subject_id[]" class="form-control" >
                                                                    <option value="">Select Subject</option>
                                                                    @foreach ($subject as $item)
                                                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                                    @endforeach
                                                                </select>

                                                                @error('subject_id.*')
                                                                <span style="color: red;font-size: 12px" class="invalid-feedback error" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                                @enderror

                                                            </div>

                                                            <div class="col-md-2" style="padding-top: 20px">
                                                                <label style="color: black">Full Marks</label>
                                                                <input type="text" name="full_marks[]" id="full_marks" class="form-control" placeholder="Full Marks" >

                                                                @error('full_marks.*')
                                                                <span style="color: red;font-size: 12px" class="invalid-feedback error" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                                @enderror
                                                            </div>

                                                            <div class="col-md-2" style="padding-top: 20px">
                                                                <label style="color: black">Pass Marks</label>
                                                                <input type="text" name="pass_marks[]" id="pass_marks" class="form-control" placeholder="Pass Marks" >

                                                                @error('pass_marks.*')
                                                                <span style="color: red;font-size: 12px" class="invalid-feedback error" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                                @enderror
                                                            </div>

                                                            <div class="col-md-2" style="padding-top: 20px">
                                                                <label style="color: black">Subjective Marks</label>
                                                                <input type="text" name="subjective_marks[]" id="subjective_marks" class="form-control" placeholder="Subjective Marks" >

                                                                @error('subjective_marks.*')
                                                                <span style="color: red;font-size: 12px" class="invalid-feedback error" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                                @enderror
                                                            </div>


                                                            <div class="col-md-2" style="padding-top: 45px">
                                                                <span class="btn btn-success addeventmore"><i class="fa fa-plus-circle"></i></span>
                                                            </div>
                                                        </div>

                                                    </div>

                                                    <div class="form-group col-md-12" style="padding-top: 10px">
                                                        <input id="storeButton" class="btn btn-primary" type="submit" value="Save">
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


<div style="visibility: hidden">
    <div class="whole_extra_item_add" id="whole_extra_item_add">
        <div class="delete_extra_item_add" id="delete_extra_item_add">
            
            <div class="form-group row">
                <div class="col-md-4" style="padding-top: 20px">
                    <label style="color: black">Subject</label>
                    <select id="subject_id" name="subject_id[]" class="form-control" >
                        <option value="">Select Subject</option>
                        @foreach ($subject as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>

                    @error('subject_id.*')
                    <span style="color: red;font-size: 12px" class="invalid-feedback error" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror

                </div>

                <div class="col-md-2" style="padding-top: 20px">
                    <label style="color: black">Full Marks</label>
                    <input type="text" name="full_marks[]" id="full_marks" class="form-control" placeholder="Full Marks" >

                    @error('full_marks.*')
                    <span style="color: red;font-size: 12px" class="invalid-feedback error" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="col-md-2" style="padding-top: 20px">
                    <label style="color: black">Pass Marks</label>
                    <input type="text" name="pass_marks[]" id="pass_marks" class="form-control" placeholder="Pass Marks" >

                    @error('pass_marks.*')
                    <span style="color: red;font-size: 12px" class="invalid-feedback error" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="col-md-2" style="padding-top: 20px">
                    <label style="color: black">Subjective Marks</label>
                    <input type="text" name="subjective_marks[]" id="subjective_marks" class="form-control" placeholder="Subjective Marks" >

                    @error('subjective_marks.*')
                    <span style="color: red;font-size: 12px" class="invalid-feedback error" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>


                <div class="col-md-2" style="padding-top: 45px">
                    <span class="btn btn-success addeventmore"><i class="fa fa-plus-circle"></i></span>
                    <span class="btn btn-danger removeeventmore"><i class="fa fa-minus-circle"></i></span>
                </div>
            </div>

        </div>
    </div>
</div>


{{-- Extra add item --}}
<script>
    $(document).ready(function(){
        var counter = 0;
        $(document).on("click",".addeventmore",function(){
            var whole_extra_item_add = $("#whole_extra_item_add").html();
            $(this).closest(".add_item").append(whole_extra_item_add);
            counter++;
        });

        $(document).on("click",".removeeventmore",function(event){
            $(this).closest(".delete_extra_item_add").remove();
            counter -=1;
        });

    });


</script>

{{-- validation --}}
{{-- <script>

    //store validation
    $(document).on('click','#storeButton',function(){

    var class_id = $("#class_id").val();
    var class_id = $("#class_id").val();
    var amount = $("#amount").val();
    
    if(class_id==''){
        $.notify("Sorry! You do not select fee category.", {globalPosition:'top right',className:'error'});
        return false;
    }

   
    });

   

//store validation End
</script> --}}

{{-- <script type="text/javascript">
             
    $(document).ready(function(){

        $( "#myForm" ).validate( {

            rules: {
                'fee_category_id': {
                    required: true,
                },
                'class_id[]': {
                    required: true,
                },

        },

        messages: {
            'sup_fee_category_id': {
                 required: "Please Select  suplier name.",
                    },
            'class_id[]': {
                required: "Please Select name.",
                },
               
                     
            },
               
           
            errorElement: "em",
            errorPlacement: function ( error, element ) {
                // Add the `invalid-feedback` class to the error element
                error.addClass( "invalid-feedback" );

                if ( element.prop( "type" ) === "checkbox" ) {
                    error.insertAfter( element.next( "label" ) );
                } else {
                    error.insertAfter( element );
                }
            },
            highlight: function ( element, errorClass, validClass ) {
                $( element ).addClass( "is-invalid" ).removeClass( "is-valid" );
            },
            unhighlight: function (element, errorClass, validClass) {
                $( element ).addClass( "is-valid" ).removeClass( "is-invalid" );
            }
        } );

    });
</script> --}}

{{-- <script type="text/javascript">


    $(document).ready(function() {
        $("#storeButton").click(function(e){
            e.preventDefault();
            var _token = $("input[name='_token']").val();
            var fee_category_id = $('#fee_category_id').val();
            var class_id = $("input[name='class_id[]']").val();
            var amount = $('#amount').val();

            $.ajax({
            type:'post',
            url:'{{ route('students.fee.amount.store') }}',
            data:{_token:_token,fee_category_id:fee_category_id,class_id:class_id,amount:amount},
            success:function(data){
                if($.isEmptyObject(data.error)){
                $(".print-error-msg").show('slow');
                $(".print-error-msg ul li").html(data.success)
                }else{
                $(".print-error-msg").show('slow');
                $(".print-error-msg ul li").html(data.error)
                }
            },
            error:function(data){
                console.log(data);
            }

        });
           


        }); 
       
    });


    $(".print-error-msg").on('click',function(){
        $(".print-error-msg").hide('slow');
    })


</script> --}}



@endsection