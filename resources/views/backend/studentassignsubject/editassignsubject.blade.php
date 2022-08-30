
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
                                            Edit Assign Subject

                                        <a style="float: right" class="btn btn-success" href="{{ route('students.assign.subject.view') }}"> <i class="fa fa-list" aria-hidden="true"></i> Assign Subject List </a>
                                       
                                    </div>

                                    <div style="background: #fff" class="panel-body">
                                        <div class="row">
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                <form method="post" id="myForm" action="{{ route('students.assign.subject.update',$editData[0]->class_id) }}">

                                                    {{ csrf_field() }}
                                                    <div class="add_item">
                                                        <div class="form-group row">
                                                            <div class="col-md-5">
                                                                <label style="color: black">Class</label>
                                                                <select id="class_id" name="class_id" class="form-control" >
                                                                    <option value="">Select class</option>
                                                                    @foreach ($class as $item)
                                                                        <option  value="{{ $item->id }}" {{ ($editData[0]->class_id==$item->id)?"selected":"" }}>{{ $item->name }}</option>
                                                                    @endforeach
                                                                </select>
                                                              

                                                                @error('class_id')
                                                                    <span style="color: red;font-size: 12px" class="invalid-feedback error" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror

                                                            </div>
                                                        </div>

                                                        @foreach ($editData as $edit)
                                                        <div class="delete_extra_item_add" id="delete_extra_item_add">
                                                            <div class="form-group row">
                                                                <div class="col-md-4" style="padding-top: 20px">
                                                                    <label style="color: black">Subject</label>
                                                                    <select id="subject_id" name="subject_id[]" class="form-control" >
                                                                        <option disabled value="">Select Subject</option>

                                                                        <?php

                                                                        $marksEntryData = App\model\marksEntry::where('assign_subject_id',$edit->id)->first();

                                                                        $subjectitem = App\model\subject::where('id',$edit->subject_id)->first();

                                                                       
          
                                                                        
                                                                        ?>

                                                                        @if($marksEntryData==null)
                                                                            @foreach ($subject as $item)
                                                                            <option value="{{ $item->id }}" {{ ($edit->subject_id==$item->id)?"selected":"" }} >
                                                                                {{ $item->name }}
                                                                            </option>
                                                                            @endforeach
                                                                        @else
                                                                        <option value="{{$subjectitem->id}}">{{ $subjectitem->name }}</option>

                                                                        @endif


                                                                      

                                                                    </select>

                                                                    @error('subject_id.*')
                                                                    <span style="color: red;font-size: 12px" class="invalid-feedback error" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                    @enderror

                                                                </div>

                                                                <div class="col-md-2" style="padding-top: 20px">
                                                                    <label style="color: black">Full Marks</label>
                                                                    <input type="text" name="full_marks[]" id="full_marks" class="form-control" placeholder="Full Marks" value="{{ $edit->full_marks }}">

                                                                    @error('full_marks.*')
                                                                    <span style="color: red;font-size: 12px" class="invalid-feedback error" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                    @enderror
                                                                </div>

                                                                <div class="col-md-2" style="padding-top: 20px">
                                                                    <label style="color: black">Pass Marks</label>
                                                                    <input type="text" name="pass_marks[]" id="pass_marks" class="form-control" placeholder="Pass Marks" value="{{ $edit->pass_marks }}">

                                                                    @error('pass_marks.*')
                                                                    <span style="color: red;font-size: 12px" class="invalid-feedback error" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                    @enderror
                                                                </div>

                                                                <div class="col-md-2" style="padding-top: 20px">
                                                                    <label style="color: black">Subjective Marks</label>
                                                                    <input type="text" name="subjective_marks[]" id="subjective_marks" class="form-control" placeholder="Subjective Marks" value="{{ $edit->subjective_marks }}">

                                                                    @error('subjective_marks.*')
                                                                    <span style="color: red;font-size: 12px" class="invalid-feedback error" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                    @enderror
                                                                </div>

                                                                <?php

                                                                $marksEntryData = App\model\marksEntry::where('assign_subject_id',$edit->id)->first();
  
                                                                
                                                                ?>


                                                                <div class="col-md-2" style="padding-top: 45px">
                                                                    <span class="btn btn-success addeventmore"><i class="fa fa-plus-circle"></i></span>

                                                                    @if($marksEntryData==null)
                                                                    <span class="btn btn-danger removeeventmore"><i class="fa fa-minus-circle"></i></span>
                                                                    @else

                                                                    @endif
                                                                    
                                                                </div>

                                                            </div>
                                                        </div>
                                                        @endforeach

                                                    </div>

                                                    <div class="form-group col-md-12" style="padding-top: 10px">
                                                        <input id="storeButton" class="btn btn-primary" type="submit" value="Update">
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

@endsection