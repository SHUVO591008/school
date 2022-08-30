
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
                                        <h2>Expense Category</h2>

                                        <nav id="myDIV" style="padding: 25px 0px" class="nav">
                                            <a class="nav-link" href="{{ route('accounts.cost.view') }}"><i class="fa fa-list" aria-hidden="true"></i> Expense</a>
                                            <a class="nav-link" href="{{ route('accounts.cost.add') }}">Add Expense</a>
                                            <a class="nav-link active" href="{{ route('accounts.cost.category.view') }}"><i class="fa fa-plus" aria-hidden="true"></i> Expense Category</a>
                                        </nav>
                                    </div>

                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h5>
                                                @if(@isset($editData)) 
                                                Update Expense Category
                                                @else
                                                New Expense Category
                                               @endif
                                            </h5>
                                        </div>

                                        <div class="panel-body">
                                        
                                                <form method="post" id="myForm" action="@if(@isset($editData)){{ route('accounts.cost.category.update',$editData->id) }}@else{{ route('accounts.cost.category.store') }}@endif">

                                                @csrf
                                                <div class="form-group col-md-6">
                                                    <input id="name" placeholder="Enter Expense Category" type="text" name="name" value="@if(@isset($editData)){{ $editData->name }}@else{{ old('name') }}@endif" class="form-control" autocomplete="off" >
                                                    <span id="firstNameError" style="color: red"></span>

                                                    @error('name')
                                                        <span style="color: red;font-size: 12px" class="invalid-feedback error" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                     @enderror
                                                </div>

                                                <div class="form-group col-md-6">
                                                   
                                                        @if(@isset($editData)) 
                                                            <button class="btn btn-primary" type="submit">
                                                                <i class="fa fa-refresh"></i>
                                                                Update
                                                            </button> 
                                                         @else  
                                                            <button class="btn btn-primary" type="submit">
                                                                <i class="fa fa-save"></i>
                                                                Save
                                                            </button>  
                                                        @endif
                                                </div>

                                            </form>
                                        </div>
                                    </div>


                                     <div class="panel-body">
                                        <h5><strong>Expense Category</strong></h5>
                                        <hr>
                                        <table id="datatable" class="table table-striped table-bordered">
                                                    
                                            <thead>
                                                <tr>
                                                    <th width="5%">#SL</th>
                                                    <th>Category Name</th>
                                                    <th width="17%">Action </th>
                                                </tr>
                                            </thead>

                                    
                                            <tbody> 
                                                <?php $sl = 1 ?>
                                                
                                                @foreach ($allData as $item)
                                                    <tr class="{{ $item->id }}">
                                                        <td>{{ $sl++ }}</td>
                                                        <td>{{ $item->name }}</td>
                                                        
                                                        <td>
                                                            <a id="edit" href="{{route('accounts.cost.category.edit',$item->id)}}" class="btn btn-info "><i class="fa fa-edit"></i>
                                                            </a>

                                                           
                                                            <a title="Delete" style="background-color: #c0ff05" class="btn btn-success delete" href="{{ route('accounts.cost.category.delete') }}" data-token="{{ csrf_token() }}" data-id="{{ $item->id }}"> <i class="fa fa-trash" aria-hidden="true"></i></a>

                                                        </td>
                                                        
                                                    </tr>
                                                @endforeach
                
                                            </tbody>
                                        </table>
                                    </div>

                           


                                </div> <!-- panel -->
                            </div> <!-- col-12 -->
                            
                        </div> <!-- End Row -->


                    </div> <!-- container -->
                    
                </div><!-- content -->
            </div><!-- content-page -->



{{-- validation --}}
<script>

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


    $("#myForm").submit(function () {
        if(checkfirstname() == true){
            return true;
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
                   
                    if(data.msg){
                        alert(data.msg);
                    }else{

                    swal({
                        title: 'Data has Been Deleted!',
                        type: 'success',
                    });

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