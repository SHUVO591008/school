
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

                                    @if (isset($errors) && $errors->any())
                                            <div class="alert alert-danger">
                                                <ul>
                                                    @foreach ($errors->all() as $error)
                                                        <li style="list-style: none">{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                    @endif 

                                    <div class="panel-heading">
                                     Employee Salary List

                                       <a style="float: right" class="btn btn-success" href="{{ route('accounts.employee.salary.add') }}"> <i class="fa fa-plus-circle" aria-hidden="true"></i> Add/Edit Employee salary </a>

                                    </div>
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-md-12 col-sm-12 col-xs-12">


                                                <table id="datatable" class="table table-striped table-bordered">
                                                
                                                    <thead>
                                                        <tr>
                                                            <th width="10%">#SL</th>
                                                            <th>ID No</th>
                                                            <th>Employee Name</th>
                                                            <th>Date</th>
                                                            <th>Amount</th>
                                                            
                                                        </tr>
                                                    </thead>

                                             
                                                    <tbody> 
                                                        <?php $sl = 1 ?>
                                                        
                                                        @foreach ($allData as $item)
                                                            <tr class="{{ $item->id }}">
                                                                <td>{{ $sl++ }}</td>
                                                                <td>
                                                                    {{ $item['user']['id_no'] }}
                                                                </td>

                                                                <td>
                                                                    {{ $item['user']['name'] }}
                                                                </td>

                                                                <td>
                                                                    {{ date("M-Y",strtotime($item->date))}}
                                                                </td>

                                                                <td>
                                                                    {{ number_format($item->amount,2) }} TK
                                                                </td>

                                                                
                                                            </tr>
                                                        @endforeach
                        
                                                    </tbody>
                                                </table>

                                            </div>
                                        </div> <!-- End Row panal -->
                                    </div>

                                </div> <!-- panel -->
                            </div> <!-- col-12 -->
                            
                        </div> <!-- End Row -->


                    </div> <!-- container -->
                </div><!-- content -->
            </div><!-- content-page -->
                               

{{-- Delete --}}
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
{{-- delete --}}


@endsection

