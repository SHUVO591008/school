
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
                                            <a class="nav-link active" href="{{ route('accounts.cost.view') }}"><i class="fa fa-list" aria-hidden="true"></i> Expense</a>
                                            <a class="nav-link" href="{{ route('accounts.cost.add') }}">Add Expense</a>
                                            <a class="nav-link" href="{{ route('accounts.cost.category.view') }}"><i class="fa fa-plus" aria-hidden="true"></i> Expense Category</a>
                                        </nav>
                                    </div>

                                   

                                    <div class="row">
                                        <div class="col-md-12">
                                           <div style="display: none" class="alert alert-success" id="msg_div">
                                                   <span id="res_message"></span>
                                              </div>
                                        </div>
                                     </div>

                                     

                                    <?php

                                    $date = Carbon\Carbon::now();
                                   
                                    $dateS = $date->day;
                                    $month = $date->month;
                                    $year = $date->year;
                                   
                                    ?>

                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="form-group col-md-4">
                                                <input id="start_date" placeholder="Start Date" type="text" name="start_date" value="{{ $dateS }}-{{ $month }}-{{ $year }}" class="form-control" autocomplete="off" readonly>

                                                <span id="strdateerror" style="color: red"></span>
                                                @error('start_date')
                                                    <span style="color: red;font-size: 12px" class="invalid-feedback error" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-group col-md-4">
                                                <input id="end_date" placeholder="End Date" type="text" name="end_date" value="{{ $dateS }}-{{ $month }}-{{ $year }}" class="form-control" autocomplete="off" readonly>

                                                <span id="enddateerror" style="color: red"></span>
                                                @error('end_date')
                                                    <span style="color: red;font-size: 12px" class="invalid-feedback error" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-group col-md-4">
                                                <select name="category_id" class="form-control select2" id="category_id">
                                                    <option value="0" selected>Select Category</option>
                                                    @foreach ($category as $key=> $item)
                                                   
                                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
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

                                            <div class="col-md-12">
                                                <button class="btn btn-success" type="submit" id="search"><i class="fa fa-search" aria-hidden="true"></i> Search</button>
                                                <a class="btn btn-info" href="{{route('cost-reset')}}">Reset</a>
                                            </div>
                                            
                                        </div>
                                    </div>

                                    <hr>

                                   
                                    <h4 class="text-center"><strong>Expense List</strong></h4>
                                    <hr>
                                  
                                     <div id="allDate" class="panel-body">
                                        
                                        <table style="border-collapse: collapse!important;" id="datatable" class="table table-striped table-bordered text-center">         
                                            <thead>
                                                <tr>
                                                    <th width="5%">#SL</th>
                                                    <th>Category</th>
                                                    <th>Expense Name</th>
                                                    <th>Date</th>
                                                    <th>Amount</th>
                                                    <th width="15%">Note</th>
                                                    <th>Image</th>
                                                    <th width="12%">Action </th>
                                                </tr>
                                            </thead>

                                            <tbody> 
                                                <?php $sl = 1 ?>
                                                @foreach ($allData as $item)

                                                    <tr style="border: 1px solid #e4e4e4" class="{{ $item->id }}">
                                                        <td>{{ $sl++ }}</td>
                                                        <td>{{ $item['category']['name']}}</td>
                                                        <td>{{ $item->name }}</td>
                                                        <td>{{ date('d-M-Y',strtotime($item->expense_date)) }}</td>
                                                        <td>
                                                            @if($item->amount)
                                                                {{ number_format($item->amount,2) }} TK
                                                            @else
                                                                <span>0.00 TK</span>
                                                            @endif
                                                        </td>
                                                        <td>{{ $item->note }}</td>
                                                        <td style="width: 10%">
                                                            @if($item->image)
                                                            <img width="80%" src="{{ URL::asset($item->image) }}" alt="image">
                                                            @else
                                                            <img width="80%" src="{{ url('profile/No-image-found.jpg') }}" alt="image">
                                                            
                                                            @endif
                                                            
                                                        </td>
                                                        
                                                        <td>
                                                            <a id="edit" href="{{route('accounts.cost.edit',$item->id)}}" class="btn btn-info"><i class="fa fa-edit"></i>
                                                            </a>

                                                           
                                                            <a title="Delete" style="background-color: #c0ff05" class="btn btn-success delete" href="{{route('accounts.cost.delete')}}" data-token="{{ csrf_token() }}" data-id="{{ $item->id }}"> <i class="fa fa-trash" aria-hidden="true"></i></a>

                                                           
                                                        </td>

                                                        <?php
                                                        $sum = 0;
                                                        $sum = $item->sum('amount');
                                                        
                                                        ?>
                                                        
                                                    </tr>

                                                @endforeach
                
                                            </tbody>


                                            <tfoot>
                                                <tr style="border: 1px solid #e4e4e4">
                                                <td rowspan="1" colspan="4" ></td>
                                                <td colspan="1" ><strong>Total : {{ (@$sum)?number_format($sum,2):'00 TK' }}</strong></td>
                                                <td colspan="3" ></td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>

                                    <div class="panel-body">
                                        <div class="row">
                                            <div id="documentResult"></div>
                                            
                                            <script id="document-template" type="text/x-handlebars-template">
                                                <div style="width: 100%;text-align: center">
                                                    <strong>
                                                        @{{{date}}}
                                                    </strong>
                                                    <hr>
                                                </div>
                                                <br/>
                                               
                                                <table id="datatable" class="table table-striped table-bordered text-center" style="width: 100%">
                                                    <thead>
                                                        <tr>
                                                          @{{{thsource}}}
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                            @{{#each this}}
                                                            
                                                            <tr style="border: 1px solid #e4e4e4">
                                                                @{{{tdsource}}}
                                                               
                                                            </tr>
                                                            @{{/each}}
                                                        </tbody>

                                                        <tfoot>
                                                            @{{#each this}}
                                                            <tr>
                                                                @{{{tdfooter}}}
                                                            </tr>
                                                            @{{/each}}
                                                        </tfoot>
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

         
{{-- Select 2 --}}
<script>
    $(".select2").select2({
        tags: true
    });
</script>

{{-- date piker --}}
<script>
    $(function(){
        $("input[name='start_date']").datepicker({
            dateFormat: "dd-mm-yy",
            changeMonth: true,
            changeYear: true
        });
    });
</script>
<script>
    $(function(){
        $("input[name='end_date']").datepicker({
            dateFormat: "dd-mm-yy",
            changeMonth: true,
            changeYear: true
        });
    });
</script>


{{-- validation --}} {{-- search --}}
<script>
    function startdate(){
            var datevali = $("#start_date").val();
            var reg = /^(0?[1-9]|[12][0-9]|3[01])[\/\-](0?[1-9]|1[012])[\/\-]\d{4}$/;
            
            var test =$("#start_date").attr("type");

            if(reg.test(datevali)){
                $("#strdateerror").text("")
                return true;
            }else {
                $("#strdateerror").text("Start Date formate is invalid.")
                return false;
            }
    }

    $("#start_date").change(function () {
        startdate();
    });

    function enddate(){
            var datevali = $("#end_date").val();
            var reg = /^(0?[1-9]|[12][0-9]|3[01])[\/\-](0?[1-9]|1[012])[\/\-]\d{4}$/;
            
            var test =$("#end_date").attr("type");

            if(reg.test(datevali)){
                $("#enddateerror").text("")
                return true;
            }else {
                $("#enddateerror").text("End Date formate is invalid.")
                return false;
            }
    }
    $("#end_date").change(function () {
        enddate();
    });



    $('#search').click(function(){

        if(startdate() == true & enddate() == true){

        var star_date = $('#start_date').val();
        var end_date = $('#end_date').val();
        var category_id = $('#category_id').val();

        $.ajax({
            type: "get",
            url: "{{ route('cost-search') }}",
            data:{
                'star_date':star_date,
                'end_date':end_date,
                'category_id':category_id,
                },
            success:function (response) {

                if(response.msg){
                    $('#msg_div').fadeIn();
                    $('#res_message').html(response.msg);
                    // $('#roll-generate').fadeOut();
                }else{
                    $('#allDate').fadeOut();
                    $('#msg_div').fadeOut();
                }

                var source = $('#document-template').html();
                var template = Handlebars.compile(source);
                var html = template(response);
                $("#documentResult").html(html);
                $('[data-toggle="tooltip"]').tooltip();

                    
                
            }
        


            
        });


            
        }else {
            return false;
        }


        

    });

</script>  



{{-- Delet --}}
<script>
    $('.delete').on('click', function (event) {
        
    event.preventDefault();
    var action = $(this).attr('href');
    var token = $(this).attr('data-token');
    var id = $(this).attr('data-id');
    swal({
        title: 'Are you sure Delete?',
        text: 'Delete Ok!',
        icon: 'warning',
        buttons: ["Cancel", "Yes!"],
    }).then(function(value) {

        if (value) {
            $.ajax({
                url:action,
                type:'post',
                data:{id:id, _token:token},
                
                success:function(data){
                   
                    swal({
                        title: 'Delete!',
                        type: 'success',
                    });
                    
                    if(value){
                        $('.' + id).fadeOut();
                    }
                    
                }
            });
            
        }else{
            swal("Cancelled","","error");
        }

    });
    return false;
    });
</script>



@endsection