
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
                                            Edit Students Fee Amount

                                        <a style="float: right" class="btn btn-success" href="{{ route('students.fee.amount.view') }}"> <i class="fa fa-list" aria-hidden="true"></i> Student Fee Amount List </a>
                                       
                                        
                                    </div>

                                    <div style="background: #fff" class="panel-body">
                                        <div class="row">
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                <form method="post" id="myForm" action="{{ route('students.fee.amount.update',$editData[0]->fee_category_id) }}">

                                                    {{ csrf_field() }}
                                                    <div class="add_item">
                                                        <div class="form-group">
                                                            <div class="col-md-7">
                                                                <label style="color: black">Fee Category</label>
                                                                <select id="fee_category_id" name="fee_category_id" class="form-control" >
                                                                    <option value="">Select Fee Category</option>
                                                                    @foreach ($fee_category as $item)
                                                                        <option value="{{ $item->id }}" {{ ($editData[0]->fee_category_id==$item->id)?"selected":"" }}>{{ $item->name }}</option>
                                                                    @endforeach
                                                                </select>
                                                              

                                                                @error('fee_category_id')
                                                                    <span style="color: red;font-size: 12px" class="invalid-feedback error" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror

                                                            </div>
                                                        </div>

                                                        @foreach ($editData as $edit)
                                                        <div class="delete_extra_item_add" id="delete_extra_item_add">
                                                            <div class="form-group">
                                                                <div class="col-md-6" style="padding-top: 20px">
                                                                    <label style="color: black">Class</label>
                                                                    <select id="class_id" name="class_id[]" class="form-control" >
                                                                        <option value="">Select Class</option>
                                                                        @foreach ($class as $item)
                                                                            <option value="{{ $item->id }}" {{ ($edit->class_id==$item->id)?"selected":"" }}>{{ $item->name }}</option>
                                                                        @endforeach
                                                                    </select>

                                                                    @error('class_id.*')
                                                                    <span style="color: red;font-size: 12px" class="invalid-feedback error" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                    @enderror

                                                                </div>

                                                                <div class="col-md-5" style="padding-top: 20px">
                                                                    <label style="color: black">Amount</label>
                                                                    <input type="text" name="amount[]" id="amount" class="form-control" placeholder="Amount" value="{{ $edit->amount }}">

                                                                    @error('amount.*')
                                                                    <span style="color: red;font-size: 12px" class="invalid-feedback error" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                    @enderror
                                                                </div>


                                                                <div class="form-group col-md-1" style="padding-top: 45px">
                                                                    <div class="form-row">
                                                                        <span class="btn btn-success addeventmore"><i class="fa fa-plus-circle"></i></span>
                                                                        <span class="btn btn-danger removeeventmore"><i class="fa fa-minus-circle"></i></span>
                                                                    </div>
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
            <div class="form-group">
                <div class="col-md-6" style="padding-top: 20px">
                    <label style="color: black">Class</label>
                    <select id="class_id" name="class_id[]" class="form-control" >
                        <option value="">Select Class</option>
                        @foreach ($class as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>

                    @error('class_id.*')
                    <span style="color: red;font-size: 12px" class="invalid-feedback error" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="col-md-5" style="padding-top: 20px">
                    <label style="color: black">Amount</label>
                    <input  type="text" name="amount[]" id="amount" class="form-control" placeholder="Amount" >
                    @error('amount.*')
                    <span style="color: red;font-size: 12px" class="invalid-feedback error" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>


                <div class="form-group col-md-1" style="padding-top: 45px">
                    <div class="form-row">
                        <span class="btn btn-success addeventmore"><i class="fa fa-plus-circle"></i></span>
                        <span class="btn btn-danger removeeventmore"><i class="fa fa-minus-circle"></i></span>
                    </div>
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