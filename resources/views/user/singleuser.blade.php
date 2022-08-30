
@extends('layouts.app')


@section('web')
    
<div id="page-wrapper" class="gray-bg dashbard-1">
    <!-- Start content -->
    <div class="content-main">
        
        <div style="width: 1050px" class="container">
            <div class="row">
                 <!-- Basic example -->
                 <div class="col-md-2"></div>
                 <div class="col-md-8">
                    <div style="background: #f5e0e0" class="panel panel-default">
                        <div class="panel-heading"><h3 class="panel-title">User Details</h3></div>
                        <div class="panel-body">

                            <div class="form-group text-center">
                                <img class="img-circle" style="width: 200px; height:200px" src="{{(!empty($user->image))?url($user->image):url('profile/avatar.png') }}"/>
                            </div>
                         

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Name</label>
                                    <p>{{ $user->name }}</p>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Email</label>
                                    @if ($user->email==null)
                                        <p>N/A</p>
                                     @else
                                        <p>{{ $user->email }}</p>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Address</label>
                                    
                                    @if ($user->address==null)
                                        <p>N/A</p>
                                    @else
                                        <p>{{ $user->address }}</p>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">User Type</label>
                                 
                                    @if ($user->usertype==null)
                                        <p>N/A</p>
                                    @else
                                        <p>{{ $user->usertype }}</p>
                                    @endif
                                </div>


                                <div class="form-group">
                                    <label for="exampleInputEmail1">Mobile</label>
                                    
                                    @if ($user->mobile==null)
                                        <p>N/A</p>
                                    @else
                                        <p>{{ $user->mobile }}</p>
                                    @endif
                                </div>


                                <div class="form-group">
                                    <label for="exampleInputEmail1">Gender</label>
                                    @if ($user->gender==null)
                                        <p>N/A</p>
                                    @else
                                        <p>{{ $user->gender }}</p>
                                    @endif
                                </div>


                                


                             
                        </div><!-- panel-body -->
                    </div> <!-- panel -->
                </div> <!-- col-->
            </div>
        </div>
    </div>
</div>

@endsection