
@extends('layouts.app')


@section('web')
<style>
    a.nav-link {
    font-size: 12px;
    font-weight: 600;
    padding: 0.75rem 1rem 1rem;
    text-decoration: none;
    text-transform: uppercase;
    

    }

    .active {
        border-bottom: 3px solid burlywood;
    }

</style>

  {{-- date Picker --}}
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

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
                                        <h2>Expense</h2>

                                        <nav id="myDIV" style="padding: 25px 0px" class="nav">
                                            <a class="nav-link" href="{{ route('accounts.cost.view') }}"><i class="fa fa-list" aria-hidden="true"></i> Expense</a>
                                            <a class="nav-link active" href="{{ route('accounts.cost.add') }}">Add Expense</a>
                                            <a class="nav-link" href="{{ route('accounts.cost.category.view') }}"><i class="fa fa-plus" aria-hidden="true"></i> Expense Category</a>
                                        </nav>

                                      
                                    </div>

                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h5>
                                                @if(@isset($editData))
                                                    Edit Expense
                                                @else
                                                    New Expense
                                                @endif
                                            </h5>
                                        </div>

                                        <div class="panel-body">
                                             <div class="row">
                                                <div class="col-md-12 col-sm-12">
                                                    <form method="post" id="myForm" action="@if(@isset($editData)){{ route('accounts.cost.update',$editData->id) }}@else{{ route('accounts.cost.store') }}@endif" enctype="multipart/form-data">
                                                        @csrf

                                                        <div class="add_item">
                                                            <div style="padding-bottom: 30px" class="row">
                                                                <div class="col-md-5">
                                                                    <label style="color: black">Expens Date</label>
                                                                    <input id="date" placeholder="dd-mm-yy" type="text" name="date" value="@if(@isset($editData)){{ date('d-m-Y',strtotime($editData->expense_date)) }}@endif" class="form-control" autocomplete="off" readonly>
                
                                                        
                                                                    <span id="dateerror" style="color: red"></span>
                
                                                                    @error('date')
                                                                        <span style="color: red;font-size: 12px" class="invalid-feedback error" role="alert">
                                                                            <strong>{{ $message }}</strong>
                                                                        </span>
                                                                     @enderror
                                                                </div>
                                                            </div>

                                                          
                                                            <div class="row">

                                                                <div class="form-group col-md-3">
                                                                    <label style="color: black">Expens Category</label>
                                                                    <select name="category_id" class="form-control select2" id="category_id">
                                                                        <option selected disabled>Select Category</option>
                                                                        @foreach ($category as $key=> $item)
                                                                       
                                                                        <option @if(@isset($editData)) {{ ($editData->category_id==$item->id)?"selected":"" }}  @endif value="{{ $item->id }}">{{ $item->name }}</option>

                                                                        @endforeach
                                                                    </select>
                                                                    <br>
                                                                    <span id="category_iderror" style="color: red;display:block;"></span>
                
                                                                    @error('category_id')
                                                                        <span style="color: red;font-size: 12px" class="invalid-feedback error" role="alert">
                                                                            <strong>{{ $message }}</strong>
                                                                        </span>
                                                                     @enderror
                                                                </div>
                                                                
                                                                <div class="form-group col-md-3">
                                                                    <label style="color: black">Expens Name</label>
                                                                    <input id="name" placeholder="Enter Expense name" type="text" name="name" value="@if(@isset($editData)){{ $editData->name }}@else{{ old('name') }}@endif" class="form-control" autocomplete="off" >
                                                                    <br>
                                                                    <span id="firstNameError" style="color: red"></span>
                
                                                                    @error('name')
                                                                        <span style="color: red;font-size: 12px" class="invalid-feedback error" role="alert">
                                                                            <strong>{{ $message }}</strong>
                                                                        </span>
                                                                     @enderror
                                                                </div>
                
                                                                <div class="form-group col-md-3">
                                                                    <label style="color: black">Expens Amount</label>
                                                                    <input id="amount" placeholder="Enter Expense amount" type="text" name="amount" value="@if(@isset($editData)){{ number_format($editData->amount,2) }}@else{{ old('amount') }}@endif" class="form-control" autocomplete="off" >
                                                                    <br>
                                                                    <span id="amounterror" style="color: red"></span>
                
                                                                    @error('amount')
                                                                        <span style="color: red;font-size: 12px" class="invalid-feedback error" role="alert">
                                                                            <strong>{{ $message }}</strong>
                                                                        </span>
                                                                     @enderror
                                                                </div>

                                                                <div class="form-group col-md-3">
                                                                    <label style="color: black">Expens Note</label>
                
                                                                    <textarea style="resize: none" placeholder="Enter Optional Note" name="note" class="form-control" autocomplete="off">@if(@isset($editData)){{ $editData->note }}@else{{ old('note') }}@endif</textarea>
                                                                    <br>
            
                                                                    <span id="noteerror" style="color: red"></span>
                
                                                                    @error('note')
                                                                        <span style="color: red;font-size: 12px" class="invalid-feedback error" role="alert">
                                                                            <strong>{{ $message }}</strong>
                                                                        </span>
                                                                     @enderror
                                                                </div>
                
                                                                <div class="form-group col-md-4">
                                                                    <label style="color: black">Image</label>
                                                                    <input accept="image/*" type="file" class="form-control @error('image') is-invalid @enderror upload" name="image" onchange="readURL(this);" id="img">
                
                                                                    <img style="width: 100px;height: 110px; border: 1px solid gray" id="image" 
                                                                    src="
                                                                    @if(@isset($editData))
                                                                        @if($editData->image==null)
                                                                            {{ url('profile/No-image-found.jpg') }}
                                                                        @else
                                                                            {{ url($editData->image) }}
                                                                        @endif
                                                                    @else
                                                                    {{ url('profile/No-image-found.jpg') }}
                                                                    @endif" />
                                                                    <br>
                                                                   
                                                                    <span id="img_id" style="color: red"></span>
                
                                                                    @error('image')
                                                                        <span style="color: red;font-size: 12px" class="invalid-feedback error" role="alert">
                                                                            <strong>{{ $message }}</strong>
                                                                        </span>
                                                                     @enderror
                
                                                                </div>
    
                                                            </div>
                                                        </div>

                                                        <div class="form-group col-md-12">
                                                            <button class="btn btn-primary" type="submit">
                                                                
                                                               @if(@isset($editData))
                                                               <i class="fa fa-refresh" aria-hidden="true"></i> Update
                                                               @else
                                                               <i class="fa fa-save"></i> Save
                                                               @endif
                                                            </button>  
                                                        </div>

                                                    </form>





                                                </div>
                                             </div>

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
    function datevalidation(){
        var datevali = $("#date").val();
        var reg = /^(0?[1-9]|[12][0-9]|3[01])[\/\-](0?[1-9]|1[012])[\/\-]\d{4}$/;
        
        var test =$("#date").attr("type");

        if(reg.test(datevali)){
            $("#dateerror").text("")
            return true;
        }else {
            $("#dateerror").text("Date formate is invalid.")
            return false;
        }
    }

    $("#date").change(function () {
        datevalidation()
    });



    function checkfirstname(){
        var firstName = $("#name").val();
        var reg = /^[a-zA-Z -.]{3,55}$/;
        
        var test =$("#name").attr("type");

        if(reg.test(firstName)){
            $("#firstNameError").text("")
            return true;
        }else {
            $("#firstNameError").text("Category formate is invalid.")
            return false;
        }
    }

    $("#name").keyup(function () {
            checkfirstname()
    });


    //  amount
    function amount(){
        //numberWithCommas
        var exp_amount = $("#amount").val();
        
         //numberWithCommas

        var reg = /^-?(?:\d+|\d{1,3}(?:,\d{3})+)(?:(\.|,)\d+)?$/;

        if(reg.test(exp_amount)){
            $("#amounterror").text("")
            $('#amount').val(numberWithCommas(exp_amount));
            return true;
        }else {
            $("#amounterror").text("Amount formate is invalid.")
            return false;
        }

        
    }


    $("#amount").keyup(function () {
        amount();
    });

    
    //numberWithCommas
    function numberWithCommas(exp_amount) {
        var parts = exp_amount.toString().split(".");
        parts[0] = parts[0].replace(",", "").replace(/(\d+)(\d{3})/, "$1,$2");
        
        return parts.join(".");
    }
     //numberWithCommas end


      //  category
      function category(){
        var category = $("#category_id").val();
        var reg = /[0-9]|\./;

        if(reg.test(category)){
            $("#category_iderror").text("")
            return true;
        }else {
            $("#category_iderror").text("Category formate is invalid.")
            return false;
        }
        
        
    }

    $("#category_id").change(function () {
        category()
    });


     //  image
    //  function image1(){
    // var img = $("#img").val();
    // var reg = /([a-zA-Z0-9\s_\\.\-:])+(.png|.jpg|.jpeg)$/;

    // if(reg.test(img)){
    //     $("#img_id").text("")
    //     return true;
    // }else {
    //     $("#img_id").text("Image formate is invalid.")
    //     return false;
    // }
    
    
    // }

    // $("#img").change(function () {
    //     image1()
    // });




    $("#myForm").submit(function () {
        if(checkfirstname() == true & amount() == true & category() == true & datevalidation() == true){
            return true;
        }else {
            return false;
        }
    });



</script>  




{{-- date piker --}}
<script>
    $(function(){
        $("input[name='date']").datepicker({
            dateFormat: "dd-mm-yy",
            changeMonth: true,
            changeYear: true
        });
    });
</script>

{{-- image show --}}
<script type="text/javascript">

    function readURL(input){
        if(input.files && input.files[0]){
            var reader = new FileReader();
            reader.onload = function(e){
                $('#image')
                .attr('src',e.target.result)
                // .width(80)
                // .height(80);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>

@endsection