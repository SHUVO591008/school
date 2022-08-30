
@extends('layouts.app')


@section('web')
<style>
.select2-container {
    width: 100%!important;
}


</style>

<?php
use App\District;


$districName = District::where('division_id',@$editData->division_id)->get();

?>
        <!-- Select 2 -->
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
                                        @if(@isset($editData))
                                            Edit District
                                        @else
                                            Add District
                                        @endif

                                        <a style="float: right" class="btn btn-success" href="{{ route('district.view') }}"> <i class="fa fa-list" aria-hidden="true"></i> District List </a>
                                       

                                
                                        
                                    </div>

                                    <div style="background: #fff" class="panel-body">
                                        <div class="row">
                                            <div class="col-md-12 col-sm-12 col-xs-12">

                                            @if(Session::has('message'))
                                                <div class="alert alert-danger">
                                                    {{Session::get('message')}}
                                                </div>
                                            @endif
                                            

                                                <form method="post" id="myForm" action="@if(@isset($editData)){{ route('district.update',$editData->id) }}@else{{ route('district.store') }}@endif">
                                                    @csrf
                                                    <div class="form-row">
                                                       
                                                        <div class="form-group col-md-6">
                                                            <label style="color: black">Division Name</label>
                                                            <select name="division_id" id="division_id" class="form-control select2">
                                                                <option disabled selected value="">Select Division</option>

                                                                @foreach ($Division as $item)
                                                                    <option value="{{$item->id}}" {{(@$editData->division_id==$item->id)?"selected":""}}>{{$item->name}}</option>
                                                                @endforeach
                                                                
                                                            </select>

                                                            <span id="divisionidError" style="color: red"></span>

                                                            @error('division_id')
                                                                <span style="color: red;font-size: 12px" class="invalid-feedback error" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                             @enderror

                                                        </div>

                                                        <div class="form-group col-md-6">
                                                            <label style="color: black">District Name</label>
                                                            <!-- <input id="name" placeholder="District" type="text" name="name" value="@if(@isset($editData)){{ $editData->name }}@else{{ old('name') }}@endif" class="form-control js-example-tokenizer" autocomplete="off"  multiple="multiple"> -->
                                                            <select id="name" name="name[]" class="form-control js-example-tokenizer " multiple="multiple">
                                                                <option disabled  value="">Select District</option>
                                                        
                                                            
                                                                @foreach ($districName as $item)
                                                                    <option value="{{$item->name}}" selected>{{$item->name}}</option>
                                                                @endforeach
                                                            </select>

                                                            <span id="firstNameError" style="color: red"></span>

                                                            @if($errors->has('name'))
                                                                <span style="color: red;font-size: 12px" class="invalid-feedback" role="alert">
                                                                    <strong>{{ $errors->first('name') }}</strong>
                                                                </span>
                                                            @endif

                                                        </div>


                                                        <div class="form-group col-md-12">
                                                            <input class="btn btn-primary" type="submit" value="@if(@isset($editData)) Update @else Save @endif">
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
         <!-- Select  -->
<script>
    $(".select2").select2({
        tags:true,
    });

    $(".js-example-tokenizer").select2({
    //placeholder: "District Name",
    tags: true,
    tokenSeparators: [',', '']
})
</script>


<!-- validation -->
<script>



    function checkfirstname(){
        var firstName = $("#name").val();
        var reg = /[a-zA-Z -,]$/;

        if(firstName==null){
            $("#firstNameError").text("District Name formate is invalid.")
            return false;
        }

      
        var test =$("#name").attr("type");
        if(reg.test(firstName)){
            $("#firstNameError").text("")
            return true;
        }else {
          
            $("#firstNameError").text("District Name formate is invalid.")
            return false;
        }
    }

    function divisionid(){
        var division_id = $("#division_id").val();
        var reg = /^[0-9]*$/;

        var test =$("#division_id").attr("type");

        if(reg.test(division_id)){
            $("#divisionidError").text("")
            return true;
        }else {
            $("#divisionidError").text("Division formate is invalid.")
            return false;
        }
    }


    $("#name").keyup(function () {
            checkfirstname()
    });

    $("#division_id").change(function () {
        divisionid()
    });


    $("#myForm").submit(function () {
        if(checkfirstname() == true & divisionid() == true){
            return true;
        }else {
            return false;
        }
    });

</script>          

<!-- ajax -->
<script>
    $(function(){
        $(document).on('change','#division_id',function(){

            var division_id = $(this).val();

            $.ajax({
                type:"GET",
                url:"{{route('get.district.name')}}",
                data:{division_id:division_id},
                success:function(data){

                   
                    
                    var html = '<option disabled value="">Select District</option>';

                    $.each(data,function(key,v){
                        html +='<option selected value="'+v.name+'">'+v.name+'</option>';
                    });

                    $('#name').html(html);

                    // var district_id = "{{@$editData->district_id}}";

                    // if(district_id !==''){
                    //     $('#district_id').val(district_id);
                    // }
                }
            })


            
        })
    });
</script>


@endsection