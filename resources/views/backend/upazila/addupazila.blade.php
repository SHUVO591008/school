
@extends('layouts.app')


@section('web')

<style>
.select2-container {
    width: 100%!important;
}

</style>



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
                                            Edit Upazila
                                        @else
                                            Add Upazila
                                        @endif

                                        <a style="float: right" class="btn btn-success" href="{{ route('upazila.view') }}"> <i class="fa fa-list" aria-hidden="true"></i> Upazila List </a>
                                       
                                        
                                    </div>

                                    <div style="background: #fff" class="panel-body">
                                        <div class="row">
                                            <div class="col-md-12 col-sm-12 col-xs-12">

                                            @if(Session::has('message'))
                                                <div class="alert alert-danger">
                                                    {{Session::get('message')}}
                                                </div>
                                            @endif
                                            
                                                <form method="post" id="myForm" action="@if(@isset($editData)){{ route('upazila.update',$editData->id) }}@else{{ route('upazila.store') }}@endif">
                                                    @csrf
                                                    <div class="form-row">
                                                       
                                                        <div class="form-group col-md-4">
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


                                                        <div class="form-group col-md-4">
                                                            <label style="color: black">District Name</label>
                                                            <select name="district_id" id="district_id" class="form-control select2">

                                                                <option disabled selected value="">Select District</option>
                                                            
                                                            </select>

                                                            <span id="districtidError" style="color: red"></span>

                                                            @error('district_id')
                                                                <span style="color: red;font-size: 12px" class="invalid-feedback error" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                             @enderror

                                                        </div>

                                                        <div class="form-group col-md-4">
                                                            <label style="color: black">Upazila Name</label>
                                                            <!-- <input id="name" placeholder="Upozila" type="text" name="name" value="@if(@isset($editData)){{ $editData->name }}@else{{ old('name') }}@endif" class="form-control" autocomplete="off" > -->
                                                            <select id="name" name="name[]" class="form-control js-example-tokenizer " multiple="multiple">
                                                                <option disabled  value="">Upazila Name</option>

                                                            </select>

                                                            <span id="firstNameError" style="color: red"></span>

                                                            @error('name')
                                                                <span style="color: red;font-size: 12px" class="invalid-feedback error" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                             @enderror
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

<!-- validation -->
<script>



    function checkfirstname(){
        var firstName = $("#name").val();
        var reg = /[a-zA-Z -,]$/;

        if(firstName==null){
            $("#firstNameError").text("Upozila Name formate is invalid.")
            return false;
        }

      
        var test =$("#name").attr("type");
        if(reg.test(firstName)){
            $("#firstNameError").text("")
            return true;
        }else {
          
            $("#firstNameError").text("Upozila Name formate is invalid.")
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

    function districtid(){
        var district_id = $("#district_id").val();
        var reg = /^[0-9]*$/;

        var test =$("#district_id").attr("type");

        if(reg.test(district_id)){
            $("#districtidError").text("")
            return true;
        }else {
            $("#districtidError").text("District formate is invalid.")
            return false;
        }
    }


    $("#name").keyup(function () {
            checkfirstname()
    });

    $("#division_id").change(function () {
        divisionid()
    });

    $("#district_id").change(function () {
        districtid()
    });


    $("#myForm").submit(function () {
        if(checkfirstname() == true & divisionid() == true & districtid() == true){
            return true;
        }else {
            return false;
        }
    });



</script> 
<!-- Select 2  -->
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

<!-- ajax -->
<script>
    $(function(){
       
        $(document).on('change','#division_id',function(){
            var division_id = $(this).val();

            
            $.ajax({
                type:"GET",
                url:"{{route('get.district')}}",
                data:{division_id:division_id},
                success:function(data){
                    
                    var html = '<option disabled selected value="">Select District</option>';

                    $.each(data,function(key,v){
                        html +='<option value="'+v.id+'">'+v.name+'</option>';
                    });

                    $('#district_id').html(html);

                    var district_id = "{{@$editData->district_id}}";


                    $('#district_id').val(district_id).trigger('change');
                }
            })
        })
    })
</script>
<!-- ajax -->
<script>
    $(function(){
        var division_id = "{{@$editData->division_id}}";
        if(division_id){
            $('#division_id').val(division_id).trigger('change');

        }
    });
</script>


<!-- ajax -->
<script>
    $(function(){
        $(document).on('change','#district_id',function(){

            var district_id = $(this).val();

            $.ajax({
                type:"GET",
                url:"{{route('get.upazila.name')}}",
                data:{district_id:district_id},
                success:function(data){

                   
                    
                    var html = '<option disabled value="">Select Upazila</option>';

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