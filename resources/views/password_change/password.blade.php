
@extends('layouts.app')


@section('web')

            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->                      
            <div style="margin: auto;width: 50%" id="wrapper">
            
                        <div class="row">
                            <div class="col-md-12">
                                <div class="panel panel-default">

                                    <div class="panel-heading">
                                        <h3  class="panel-title">Password Change

                                            <a style="float: right" class="btn btn-success" href="{{ route('profile.view') }}"> <i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
                                        </h3>
                                        
                                    </div>

                                    <div style="background: #d1d0d6" class="panel-body">
                                        <div class="row">
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                <form method="post" id="myForm" action="{{ route('password.change') }}" >
                                                    @csrf
                                                    <div class="form-row">
                                                        <div class="form-group col-md-4">
                                                            <label>Old Password</label>
                                                            <input placeholder="Old Password" type="password" name="old_pwd" value="{{ old('old_pwd') }}" class="form-control @error('password') is-invalid @enderror" required>

                                                         @error('old_pwd')
                                                         <span style="font-size: 11px;
                                                     color: red;" class="invalid-feedback" role="alert">
                                                         <strong>{{ $message }}</strong>
                                                         </span>
                                                     @enderror

                                                        </div>

                                                        <div class="form-group col-md-4">
                                                            <label>New Password</label>
                                                            <input placeholder="New Password" type="password" name="password" value="{{ old('new_pwd') }}" class="form-control"  id="password" required>
                                                      

                                                        @error('new_pwd')
                                                            <span class="invalid-feedback error" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                         @enderror

                                                        </div>

                                                        <div class="form-group col-md-4">
                                                            <label>Confirm Password</label>
                                                            <input placeholder="Confirm Password" type="password" name="cnfrmpassword" value="{{ old('Confirm') }}" class="form-control" required>

                                                        @error('confirm_pwd')
                                                            <span class="invalid-feedback error" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                         @enderror
                                                        </div>

                                                       

                                                      

                                                        <div class="form-group col-md-6">
                                                            
                                                            <input class="btn btn-primary" type="submit" value="Change">
                                                        </div>


                                                    </div>
                                                </form>
                                            </div>
                                        </div> <!-- End Row panal -->
                                    </div>

                                </div> <!-- panel -->
                            </div> <!-- col-12 -->
                            
                        </div> <!-- End Row -->


            </div><!-- content-page -->


      
           

@endsection