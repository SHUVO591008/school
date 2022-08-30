
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
                                        Edit User

                                            <a style="float: right" class="btn btn-success" href="{{ route('users.view') }}"> <i class="fa fa-list" aria-hidden="true"></i> User List </a>
                                      
                                        
                                    </div>

                                    <div style="background: #d1d0d6" class="panel-body">
                                        <div class="row">
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                <form method="post" id="myForm" action="{{ route('users.update',$userfind->id) }}" >
                                                    @csrf
                                                    <div class="form-row">
                                                        <div class="form-group col-md-4">
                                                            <label>Role</label>
                                                            <select name="role" id="user-type" class="form-control" required>
                                                            <option hidden value="">Select Role</option>

                                                        <option value="Admin" {{ ($userfind->role=='Admin')?"selected":"" }}>Admin</option>
                                                            <option value="Operator" {{ ($userfind->role=='Operator')?"selected":"" }}>Operator</option>
                                                                
                                                            </select>
                                                        </div>

                                                        <div class="form-group col-md-4">
                                                            <label>Name</label>
                                                            <input placeholder="Name" type="text" name="name" value="{{ $userfind->name }}" class="form-control" required>

                                                            @error('name')
                                                                <span class="invalid-feedback error" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                             @enderror
                                                        </div>

                                                        <div class="form-group col-md-4">
                                                            <label>Email</label>
                                                        <input placeholder="Email" type="email" name="email" class="form-control" value="{{ $userfind->email }}" required>

                                                        @error('email')
                                                            <span class="invalid-feedback error" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                         @enderror
                                                        </div>

                                                        

                                                       

                                                        <div class="form-group col-md-6">
                                                            
                                                            <input class="btn btn-primary" type="submit" value="Update">
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

                         
                

@endsection